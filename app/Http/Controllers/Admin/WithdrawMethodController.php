<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use App\Models\WithdrawMethod;
use Illuminate\Support\Facades\Validator;

class WithdrawMethodController extends Controller
{
    public function methods()
    {
        $page_title = 'Withdraw Methods';
        $methods = WithdrawMethod::orderByDesc('status')->orderBy('id')->get();
        return view('admin.withdraw.methods', compact('page_title','methods'));
    }
    public function create()
    {
        $page_title = 'New Withdraw Method';
        return view('admin.withdraw.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $validation_rule = [
            'name'           => 'required|max: 60',
            'image'          => 'required|image',
            'image'          => [new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'rate'           => 'required|gt:0',
            'delay'          => 'required',
            'currency'       => 'required',
            'min_limit'      => 'required|gt:0',
            'max_limit'      => 'required|gte:0',
            'fixed_charge'   => 'required|gte:0',
            'percent_charge' => 'required|between:0,100',
            'instruction'    => 'required|max:64000',
            'ud.*'           => 'required',
        ];
        $request->validate($validation_rule, [], ['ud.*' => 'All user data']);

        $filename = '';
        if ($request->hasFile('image')) {
            try {
                $filename = upload_image($request->image, config('constants.withdraw.method.path'), config('constants.withdraw.method.size'));
            } catch (\Exception $exp) {
                return back()->withErrors('Image could not be uploaded.');
            }
        }

        $method = WithdrawMethod::create([
            'name'           => $request->name,
            'image'          => $filename,
            'rate'           => $request->rate,
            'delay'          => $request->delay,
            'min_limit'      => $request->min_limit,
            'max_limit'      => $request->max_limit,
            'fixed_charge'   => $request->fixed_charge,
            'percent_charge' => $request->percent_charge,
            'currency'       => $request->currency,
            'description'    => $request->instruction,
            'user_data' => $request->ud ? json_encode($request->ud) : json_encode([]),
        ]);

        return redirect()->route('admin.withdraw.method.methods')->with('success', $method->name . ' has been added.');
    }

    public function edit($id)
    {
        $page_title = 'Update Withdraw Method';
        $method = WithdrawMethod::findOrFail($id);
        return view('admin.withdraw.edit', compact('page_title', 'method'));
    }


    public function update(Request $request, $id)
    {
        $validation_rule = [
            'name'           => 'required|max: 60',
            'image'          => 'nullable|image',
            'image'          => [new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'rate'           => 'required|gt:0',
            'delay'          => 'required',
            'min_limit'      => 'required|gt:0',
            'max_limit'      => 'required|gte:0',
            'fixed_charge'   => 'required|gte:0',
            'percent_charge' => 'required|between:0,100',
            'currency'       => 'required',
            'instruction'    => 'required|max:64000',
            'ud.*'           => 'required',
        ];
        $request->validate($validation_rule, [], ['ud.*' => 'All user data']);

        $method = WithdrawMethod::findOrFail($id);
        $filename = $method->image;
        if ($request->hasFile('image')) {
            try {
                $filename = upload_image($request->image, config('constants.withdraw.method.path'), config('constants.withdraw.method.size'), $method->image);
            } catch (\Exception $exp) {
                return back()->withErrors( 'Image could not be uploaded.');
            }
        }

        $method->update([
            'name'           => $request->name,
            'image'          => $filename,
            'rate'           => $request->rate,
            'delay'          => $request->delay,
            'min_limit'      => $request->min_limit,
            'max_limit'      => $request->max_limit,
            'fixed_charge'   => $request->fixed_charge,
            'percent_charge' => $request->percent_charge,
            'description'    => $request->instruction,
            'user_data'      => $request->ud ?: [],
            'currency'      => $request->currency,
        ]);

        return back()->with('success', $method->name . ' has been updated.');
    }

    public function activate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $method = WithdrawMethod::findOrFail($request->id);

        $method->update(['status' => 1]);

        $notify[] = ['success', $method->name . ' has been activated.'];
        return redirect()->route('admin.withdraw.method.methods')->withNotify($notify);
    }

    public function deactivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $method = WithdrawMethod::findOrFail($request->id);

        $method->update(['status' => 0]);

        $notify[] = ['success', $method->name . ' has been deactivated.'];
        return redirect()->route('admin.withdraw.method.methods')->withNotify($notify);
    }
}
