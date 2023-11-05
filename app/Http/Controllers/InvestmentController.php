<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class InvestmentController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Investment Plan';
        $data['plans'] = Plan::orderBy('id', 'asc')->where('status',1)->get();

        return view('user.investment_plan',$data);
    }

    public function invest()
    {
        return redirect()->route('user.investment.plan')->with('success','slider Create Successfully');
    }
}
