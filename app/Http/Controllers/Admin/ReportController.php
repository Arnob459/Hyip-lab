<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trx;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transaction(Request $request)
    {

        if ($request->user)
        {
            $user = User::findOrFail($request->user);
            $page_title = 'Transaction Logs | ' .$user->username;
            $empty_message = 'No transactions.';
            $transactions = Trx::with('user')->orderBy('id', 'desc')->where('user_id', $user->id)->paginate(config('constants.table.default'));
            return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
        }

        $page_title = 'Transaction Logs';
        $transactions = Trx::with('user')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function referral(Request $request)
    {

        if ($request->user)
        {
            $user = User::findOrFail($request->user);
            $page_title = 'Referral Commission | ' .$user->username;
            $empty_message = 'No transactions.';
            $transactions = Trx::with('user')->where('user_id', $user->id)->orderBy('id', 'desc')->where('remark', 'ref_com')->paginate(config('constants.table.default'));
            return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
        }

        $page_title = 'Referral Commission';
        $transactions = Trx::with('user')->orderBy('id', 'desc')->where('remark', 'ref_com')->paginate(config('constants.table.default'));
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function interest(Request $request)
    {

        if ($request->user)
        {
            $user = User::findOrFail($request->user);
            $page_title = 'Interest History | ' .$user->username;
            $empty_message = 'No transactions.';
            $transactions = Trx::with('user')->where('user_id', $user->id)->orderBy('id', 'desc')->where('remark', 'interest')->paginate(config('constants.table.default'));
            return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
        }

        $page_title = 'Interest History';
        $transactions = Trx::with('user')->orderBy('id', 'desc')->where('remark', 'interest')->paginate(config('constants.table.default'));
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function investment(Request $request)
    {

        if ($request->user)
        {
            $user = User::findOrFail($request->user);
            $page_title = 'Investment History | ' .$user->username;
            $empty_message = 'No transactions.';
            $transactions = Trx::with('user')->orderBy('id', 'desc')->where('user_id', $user->id)->where('remark', 'invest')->paginate(config('constants.table.default'));
            return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
        }

        $page_title = 'Investment History';
        $transactions = Trx::with('user')->orderBy('id', 'desc')->where('remark', 'invest')->paginate(config('constants.table.default'));
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

}
