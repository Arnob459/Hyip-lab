<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\SettingExtra;

class ReferralController extends Controller
{
    //
    public function Index(){
        $data['page_title'] = 'Manage Referral';
        $data['levels'] = Referral::all();
        $data['info'] = SettingExtra::first();


        return view('admin.referral',$data);
    }


    public function levelStore(Request $request){


        $request->validate([
            'percent.*' => 'required|numeric|min:1',
        ]);

        Referral::truncate();

        for ($i=0 ; $i < count($request->percent)  ; $i++ ) {

            // dd($request->percent[$i]);

            Referral::create([
                'level' =>  ($i + 1),
                'percent' => $request->percent[$i],
            ]);

        }
        return back()->with('success','Levels Create Successfully');
    }

    public function commissionUpdate(Request $request){

        $this->validate($request, [
            'deposit_com' => 'required|integer|min:0|max:1',
            'invest_com' => 'required|integer|min:0|max:1',
            'invest_return_com' => 'required|integer|min:0|max:1',

        ]);

        $data = SettingExtra::first();
        $data->com_when_deposit = $request->deposit_com;
        $data->give_com_when_invest = $request->invest_com;
        $data->give_com_when_invest_return = $request->invest_return_com;
        $data->save();


        return back()->with('success','Updated Successfully');

    }


}
