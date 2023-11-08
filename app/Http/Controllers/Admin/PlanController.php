<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Intervention\Image\Facades\Image;



class PlanController extends Controller
{
    //
    public function Index(){
        $data['page_title'] = 'Manage Plan';
        $data['plans'] = Plan::orderBy('id', 'desc')->get();

        return view('admin.plan.index',$data);
    }

    public function planCreate(){
        $data['page_title'] = 'Add New Plan';
        return view('admin.plan.create',$data);
    }

    public function planStore(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'amount_type' => 'required|in:1,2',
            'minimum_amount' => $request->input('amount_type') === '1' ? 'required|numeric|gt:0' : '',
            'maximum_amount' => $request->input('amount_type') === '1' ? 'required|numeric|gt:minimum_amount' : '',
            'fixed_amount' => $request->input('amount_type') === '2' ? 'required|numeric|gt:0' : '',
            'times' => 'required|string|max:20',
            'interest' => 'required|numeric|gt:0',
            'interest_status' => 'required|integer|min:0|max:1',
            'return_interest' => 'required|integer|min:1',
            'repeat_time' => $request->input('return_interest') != '1' ? 'required|integer|min:1|max:999999999999' : '',
            'capital_back' => 'required|integer|min:0|max:1',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        if ($request->hasFile('image')) {
            try {
                $path = config('constants.plan.path');
                $size = config('constants.plan.size');
                $filename = upload_image($request->image, $path, $size);
            } catch (\Exception $exp) {

                return back()->with('error','Image could not be uploaded');
            }
        }
        $plan = new Plan ;
        $plan->plan_name = $request->input('name');
        $plan->amount_type = $request->input('amount_type');
        $plan->interest = $request->input('interest');
        $plan->lifetime = $request->input('return_interest');
        $plan->capital_back = $request->input('capital_back');
        $plan->times = $request->input('times');
        $plan->interest = $request->input('interest');
        $plan->interest_status = $request->input('interest_status');

        $plan->image = $filename;

        if ($request->input('amount_type') === '1') {
            $plan->minimum_amount = $request->input('minimum_amount');
            $plan->maximum_amount = $request->input('maximum_amount');
        } elseif ($request->input('amount_type') === '2') {
            $plan->fixed_amount = $request->input('fixed_amount');
        }
        if ($request->input('return_interest') != 1) {
            $plan->repeat_time = $request->input('repeat_time');
        }

        $plan->save();


        return back()->with('success','New Plan has been Create Successfully');

    }

    public function planEdit($id){
        $data['page_title'] = 'Edit Plan';
        $data['plan'] = Plan::findOrFail($id);


        return view('admin.plan.edit',$data);
    }

    public function planUpdate(Request $request ,$id){

        $request->validate([
            'name' => 'required|string|max:255',
            'amount_type' => 'required|in:1,2',
            'minimum_amount' => $request->input('amount_type') === '1' ? 'required|numeric|gt:0' : '',
            'maximum_amount' => $request->input('amount_type') === '1' ? 'required|numeric|gt:minimum_amount' : '',
            'fixed_amount' => $request->input('amount_type') === '2' ? 'required|numeric|gt:0' : '',
            'times' => 'required|string|max:20',
            'interest' => 'required|numeric|gt:0',
            'return_interest' => 'required|integer|min:1',
            'repeat_time' => $request->input('return_interest') != '1' ? 'required|integer|min:1|max:999999999999' : '',
            'interest_status' => 'required|integer|min:0|max:1',
            'capital_back' => 'required|integer|min:0|max:1',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',

        ]);


        $plan = Plan::findorfail($id);
        if ($request->hasFile('image')) {
            $filename = $plan->image;
            try {
                $path = config('constants.plan.path');
                $size = config('constants.plan.size');
                remove_file(config('constants.plan.path') . '/' .$plan->image);
                $filename = upload_image($request->image, $path, $size, $filename);
            } catch (\Exception $exp) {

                return back()->with('error','Image could not be uploaded');
            }
            $plan->image = $filename;
        }
        $plan->plan_name = $request->name;
        $plan->amount_type = $request->input('amount_type');
        $plan->status = $request->input('status');
        $plan->interest = $request->input('interest');
        $plan->lifetime = $request->input('return_interest');
        $plan->capital_back = $request->input('capital_back');
        $plan->times = $request->input('times');
        $plan->interest = $request->input('interest');
        $plan->interest_status = $request->input('interest_status');



        if ($request->input('amount_type') === '1') {
            $plan->minimum_amount = $request->input('minimum_amount');
            $plan->maximum_amount = $request->input('maximum_amount');
            $plan->fixed_amount = 0;

        } elseif ($request->input('amount_type') === '2') {
            $plan->fixed_amount = $request->input('fixed_amount');
            $plan->minimum_amount = 0;
            $plan->maximum_amount = 0;
        }

        if ($request->input('return_interest') != 1) {
            $plan->repeat_time = $request->input('repeat_time');
        }else {
            $plan->repeat_time = 0;
        }

        $plan->save();

        return back()->with('success', "Plan has been updated successfully");
    }



}
