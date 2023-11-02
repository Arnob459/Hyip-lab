<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gateway;
use App\Models\GatewayCurrency;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ManualGatewayController extends Controller
{
    public function index()
    {
        $page_title = 'Manual Deposit Methods';
        $empty_message = 'No deposit methods available.';
        $gateways = Gateway::manual()->latest()->paginate(config('constants.table.default'));
        return view('admin.manual_gateway.list', compact('page_title', 'empty_message', 'gateways'));
    }

    public function create()
    {
        $page_title = 'New Manual Deposit Method';
        return view('admin.manual_gateway.create', compact('page_title'));
    }

    public function edit($code)
    {
        $page_title = 'New Manual Deposit Method';
        $method = Gateway::manual()->with('single_currency')->where('code', $code)->firstOrFail();
        return view('admin.manual_gateway.edit', compact('page_title', 'method'));
    }

    public function store(Request $request)
    {

        $validation_rule = [
            'name'           => 'required|max: 60',
            'image'          => 'required|image|mimes:jpeg,jpg,png',
            'rate'           => 'required|gt:0',
            'delay'          => 'required',
            'currency'       => 'required',
            'min_limit'      => 'required|gt:0',
            'max_limit'      => 'required|gte:0',
            'fixed_charge'   => 'required|gte:0',
            'percent_charge' => 'required|between:0,100',
            'ud.*'           => 'required',
            'instruction'    => 'required|string',
            'verify_image'   => 'required|max:190',
        ];

        $request->validate($validation_rule, [], ['ud.*' => 'All user data']);
        $last_method = Gateway::manual()->latest()->first();
        $method_code = 1000;
        if ($last_method) {
            $method_code = $last_method->code + 1;
        }

        if ($request->hasFile('image')) {
            try {
                $filename = upload_image($request->image, config('constants.deposit.gateway.path'), config('constants.deposit.gateway.size'));
            } catch (\Exception $exp) {
                return back()->withError('Image could not be uploaded.');
            }
        }

        $method = Gateway::create([
            'code' => $method_code,
            'name' => $request->name,
            'alias' => $request->name,
            'image' => $filename,
            'status' => 0,
            'parameter_list' => json_encode([]),
            'extra' => ['delay' => $request->delay, 'verify_image' => $request->verify_image],
            'supported_currencies' => json_encode([]),
            'crypto' => config('constants.currency.base') == 'crypto' ? 1 : 0,
            'description' => $request->instruction,
        ]);

        $method->single_currency()->save(new GatewayCurrency([
            'name' => $request->name,
            'currency' => $request->currency,
            'symbol' => '',
            'min_amount' => $request->min_limit,
            'max_amount' => $request->max_limit,
            'fixed_charge' => $request->fixed_charge,
            'percent_charge' => $request->percent_charge,
            'rate' => $request->rate,
            'image' => $filename,
            'gateway_parameter' => $request->ud ? json_encode($request->ud) : json_encode([]),
        ]));

        return back()->withSuccess($method->name . ' Manual Gateway has been added.');
    }

    public function update(Request $request, $code)
    {
        $validation_rule = [
            'name'           => 'required|max: 60',
            'image'          => 'image|mimes:jpeg,jpg,png',
            'rate'           => 'required|gt:0',
            'delay'          => 'required',
            'currency'       => 'required',
            'min_limit'      => 'required|gt:0',
            'max_limit'      => 'required|gte:0',
            'fixed_charge'   => 'required|gte:0',
            'percent_charge' => 'required|between:0,100',
            'ud.*' => 'required',
            'instruction'    => 'required|max:64000',
            'verify_image'   => 'required|max:190',
        ];

        $request->validate($validation_rule, [], ['ud.*' => 'All user data']);
        $method = Gateway::manual()->where('code', $code)->firstOrFail();

        $filename = $method->image;
        if ($request->hasFile('image')) {
            try {
                $filename = upload_image($request->image, config('constants.deposit.gateway.path'), config('constants.deposit.gateway.size'));
            } catch (\Exception $exp) {
                $notify[] = [];
                return back()->withError('Image could not be uploaded.');
            }
        }

        $method->update([
            'name' => $request->name,
            'alias' => $request->name,
            'image' => $filename,
            'parameter_list' => json_encode([]),
            'extra' => ['delay' => $request->delay, 'verify_image' => $request->verify_image],
            'supported_currencies' => json_encode([]),
            'crypto' => config('constants.currency.base') == 'crypto' ? 1 : 0,
            'description' => $request->instruction,
        ]);

        $method->single_currency->update([
            'name' => $request->name,
            'currency' => $request->currency,
            'symbol' => '',
            'min_amount' => $request->min_limit,
            'max_amount' => $request->max_limit,
            'fixed_charge' => $request->fixed_charge,
            'percent_charge' => $request->percent_charge,
            'rate' => $request->rate,
            'image' => $filename,
            'gateway_parameter' => $request->ud ? json_encode($request->ud) : json_encode([]),
        ]);

        return back()->withSuccess($method->name . ' Manual Gateway has been updated.');
    }

    public function activate(Request $request)
    {
        $request->validate(['code' => 'required|integer']);

        $method = Gateway::where('code', $request->code)->first();

        $method->update(['status' => 1]);

        $notify[] = ['success', $method->name . ' has been activated.'];
        return back()->withNotify($notify);
    }

    public function deactivate(Request $request)
    {
        $request->validate(['code' => 'required|integer']);

        $method = Gateway::where('code', $request->code)->first();

        $method->update(['status' => 0]);

        $notify[] = ['success', $method->name . ' has been deactivated.'];
        return back()->withNotify($notify);
    }
}
