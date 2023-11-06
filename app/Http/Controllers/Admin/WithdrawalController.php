<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\Trx;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;

class WithdrawalController extends Controller
{
    public function pending()
    {
        $page_title = 'Pending Withdrawals';
        $withdrawals = Withdrawal::where('status', 2)->with(['user','method'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal is pending';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message'));
    }

    public function approved()
    {
        $page_title = 'Approved Withdrawals';
        $withdrawals = Withdrawal::where('status', 1)->with(['user','method'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal is approved';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message'));
    }

    public function rejected()
    {
        $page_title = 'Rejected Withdrawals';
        $withdrawals = Withdrawal::where('status', 3)->with(['user','method'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal is rejected';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message'));
    }

    public function log(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title = 'Withdrawal History | ' .$user->username;
            $withdrawals = Withdrawal::where('user_id', $user->id)->where('status', '!=', 0)->with(['user','method'])->latest()->paginate(config('constants.table.default'));
            $empty_message = 'No withdrawal history';
            return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message'));
        }
        $page_title = 'Withdrawal History';
        $withdrawals = Withdrawal::where('status', '!=', 0)->with(['user','method'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal history';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $withdraw = Withdrawal::where('id',$request->id)->where('status',2)->firstOrFail();
        $withdraw->status = 1;
        $withdraw->admin_feedback = $request->details;
        $withdraw->save();


        $general = Setting::first();

        // notify($withdraw->user, 'WITHDRAW_APPROVE', [
        //     'method_name' => $withdraw->method->name,
        //     'method_currency' => $withdraw->currency,
        //     'method_amount' => formatter_money($withdraw->final_amount),
        //     'amount' => formatter_money($withdraw->amount),
        //     'charge' => formatter_money($withdraw->charge),
        //     'currency' => $general->cur,
        //     'rate' => $withdraw->rate +0,
        //     'trx' => $withdraw->trx,
        //     'admin_details' => $request->details
        // ]);

        return redirect()->route('admin.withdraw.pending')->with('success', 'Withdrawal Marked  as Approved.');
    }

    public function reject(Request $request)
    {
        $general = Setting::first();
        $request->validate(['id' => 'required|integer']);
        $withdraw = Withdrawal::where('id',$request->id)->where('status',2)->firstOrFail();
        $withdraw->status = 3;
        $withdraw->admin_feedback = $request->details;
        $withdraw->save();
        $user = User::find($withdraw->user_id);
        $user->interest_balance += formatter_money($withdraw->amount);
        $user->save();

        Trx::create([
            'user_id' => $withdraw->user_id,
            'amount' => $withdraw->amount,
            'post_balance' => $user->balance,
            'charge' => 0,
            'trx_type' => '+',
            'remark' => 'withdraw_refund',
            'details' => formatter_money($withdraw->amount) . ' ' . $general->cur . ' Refunded from Withdrawal Rejection',
            'trx' => getTrx(),
            'type' => 2,
        ]);

        // notify($withdraw->user, 'WITHDRAW_REJECT', [
        //     'method_name' => $withdraw->method->name,
        //     'method_currency' => $withdraw->currency,
        //     'method_amount' => formatter_money($withdraw->final_amount),
        //     'amount' => formatter_money($withdraw->amount),
        //     'charge' => formatter_money($withdraw->charge),
        //     'currency' => $general->cur,
        //     'rate' => $withdraw->rate +0,
        //     'trx' => $withdraw->trx,
        //     'post_balance' => $user->balance +0,
        //     'admin_details' => $request->details
        // ]);

        return redirect()->route('admin.withdraw.pending')->with('success', 'Withdrawal has been rejected.');
    }

}
