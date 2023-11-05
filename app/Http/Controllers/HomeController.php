<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trx;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Invest;

use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_title'] = "Dashboard";
        $data['total_deposit'] = Deposit::where('user_id', auth()->id())->where('status', 1)->sum('amount');
        $data['total_withdrawal'] = Withdrawal::where('user_id', auth()->id())->where('status', 1)->sum('amount');
        $data['total_invest'] = Invest::where('user_id', auth()->id())->where('status', 1)->sum('amount');



        $data['total_interest_return'] = Trx::where('user_id', auth()->id())->where('remark', 'interest')->sum('amount');
        $data['today_interest_return'] = Trx::where('user_id', auth()->id())->where('remark', 'interest')->whereDate('created_at', Carbon::today()->toDateTimeString())->sum('amount');
        $data['yesterday_interest_return'] = Trx::where('user_id', auth()->id())->where('remark', 'interest')->whereDate('created_at', Carbon::yesterday()->toDateTimeString())->sum('amount');
        $data['last_7_day_interest_return'] = Trx::where('user_id', auth()->id())->where('remark', 'interest')->whereDate('created_at', '>=', Carbon::today()->subDays(6)->toDateTimeString())->sum('amount');
        $data['this_month_interest_return'] = Trx::where('user_id', auth()->id())->where('remark', 'interest')->whereDate('created_at', '>=',  Carbon::today()->subDays(29)->toDateTimeString())->sum('amount');
        $data['total_refferal_com'] = Trx::where('user_id', auth()->id())->where('remark', 'ref_com')->sum('amount');
        $data['total_refferal_user'] = User::where('refferal', auth()->id())->count();

        return view('users.dashboard', $data);
    }
}
