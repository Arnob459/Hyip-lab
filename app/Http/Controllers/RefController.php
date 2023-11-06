<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefController extends Controller
{
    public function ref()
    {
        $data['page_title'] = "Referral Statistic";
        $data['user'] = auth()->user();
       return view('users.referral_statistic', $data);
    }

    public function ref_com()
    {
        $page_title = 'Referral Commissions';
        $logs = auth()->user()->transactions()->where('remark', 'ref_com')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        return view('users.transactions', compact('page_title', 'logs'));
    }
}
