<?php

namespace App\Http\Controllers\Admin;


use App\Models\Deposit;
use App\Models\Setting;
use App\Models\SettingExtra;
use App\Models\Trx;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    public function deposit(Request $request)
    {

        if ($request->user)
        {
            $user = User::findOrFail($request->user);
            $page_title = 'Deposit History | ' .$user->username;
            $empty_message = 'No deposit history available.';
            $deposits = Deposit::where('user_id', $user->id)->with(['user', 'gateway'])->where('status','!=',0)->latest()->paginate(config('constants.table.default'));
            return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits'));
        }
        $page_title = 'Deposit History';
        $empty_message = 'No deposit history available.';
        $deposits = Deposit::with(['user', 'gateway'])->where('status','!=',0)->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits'));
    }


    public function pending()
    {
        $page_title = 'Pending Deposits';
        $empty_message = 'No pending deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', 2)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits'));
    }

    public function approved()
    {
         $page_title = 'Approved Deposits';
        $empty_message = 'No approved deposits.';
        $deposits = Deposit::where('status', 1)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits'));
    }

    public function rejected()
    {
         $page_title = 'Rejected Deposits';
        $empty_message = 'No rejected deposits.';
        $deposits = Deposit::where('method_code', '>=', 1000)->where('status', 3)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit.log', compact('page_title', 'empty_message', 'deposits'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();
        $deposit->update(['status' => 1]);

        $user = User::find($deposit->user_id);
        $user['balance'] = formatter_money(($user['balance'] + $deposit->amount));
        $user->update();
        $gnl = SettingExtra::first();

        if ($gnl->ref_com_deposit == 1)
        {
            levelCommission($user->id, $deposit->amount);
        }

        Trx::create([
            'user_id' => $deposit->user_id,
            'amount' => formatter_money($deposit->amount),
            'post_balance' => $user->balance,
            'charge' => $deposit->charge,
            'trx_type' => '+',
            'remark' => 'manual_deposit',
            'details' => 'Deposit Via ' . $deposit->gateway_currency()->name,
            'trx' => $deposit->trx
        ]);

        $gnl = Setting::first();
        // notify($user, 'DEPOSIT_APPROVE', [
        //     'method_name' => $deposit->gateway_currency()->name,
        //     'method_currency' => $deposit->method_currency,
        //     'method_amount' => formatter_money($deposit->final_amo),
        //     'amount' => formatter_money($deposit->amount),
        //     'charge' => formatter_money($deposit->charge),
        //     'currency' => $gnl->cur,
        //     'rate' => $deposit->rate +0,
        //     'trx' => $deposit->trx,
        //     'post_balance' => $user->balance
        // ]);


        return back()->with('success', 'Deposit has been approved.');
    }

    public function reject(Request $request)
    {

        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();
        $deposit->update(['status' => 3]);

        $gnl = Setting::first();
        // notify($deposit->user, 'DEPOSIT_REJECT', [
        //     'method_name' => $deposit->gateway_currency()->name,
        //     'method_currency' => $deposit->method_currency,
        //     'method_amount' => formatter_money($deposit->final_amo),
        //     'amount' => formatter_money($deposit->amount),
        //     'charge' => formatter_money($deposit->charge),
        //     'currency' => $gnl->cur,
        //     'rate' => $deposit->rate +0,
        //     'trx' => $deposit->trx
        // ]);

        return back()->with('success', 'Deposit has been rejected.');

    }
}
