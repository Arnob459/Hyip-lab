<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Settings;



class ReferralController extends Controller
{
    //
    public function Index(){
        $data['page_title'] = 'Manage Referral';
        $data['levels'] = Level::all();
        $data['info'] = Settings::first();


        return view('admin.referral.referral_list',$data);
    }


    public function levelStore(Request $request){

        // dd(count($request->percent));

        $request->validate([
            'percent.*' => 'required|numeric|min:1',
        ]);

        Level::truncate();

        for ($i=0 ; $i < count($request->percent)  ; $i++ ) {

            // dd($request->percent[$i]);

            Level::create([
                'name' => 'Level ' . ($i + 1),
                'commission' => $request->percent[$i],
            ]);

        }



        return back()->with('success','Levels Create Successfully');

    }

    public function commissionUpdate(Request $request){


        $this->validate($request, [
            'deposit_com' => 'required|integer|max:5',
            'invest_com' => 'required|integer|max:5',
            'invest_return_com' => 'required|integer|max:5',

        ]);

        $data = Settings::first();
        $data->deposit_com = $request->deposit_com;
        $data->invest_com = $request->invest_com;
        $data->invest_return_com = $request->invest_return_com;
        $data->save();


        return back()->with('success','Updated Successfully');

    }


}
