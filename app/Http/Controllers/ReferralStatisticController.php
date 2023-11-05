<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class ReferralStatisticController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Referral Statistic';
        $data['user'] = Auth::user();


        return view('user.referral_statistic',$data);
    }
}
