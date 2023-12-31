<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Deposit;
use App\Models\Invest;
use App\Models\Trx;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Withdrawal;

class AdminController extends Controller
{



      public function autoLogin($id)
     {
         $user = User::findOrFail($id);
         Auth::login($user);
         return redirect()->route('user.home');
     }


    public function dashboard()
    {
        $data['page_title'] = 'Dashboard';
        $data['total_user'] = User::count();
        $data['active_user'] = User::where('status', 1)->where('email_verify', 1)->where('sms_verify', 1)->count();
        $data['pending_user'] = User::where('status', 2)->count();
        $data['block_user'] = User::where('status', 0)->count();
        $data['email_verify'] = User::where('email_verify', 1)->count();
        $data['email_unverify'] = User::where('email_verify', 0)->count();
        $data['sms_verify'] = User::where('sms_verify', 1)->count();
        $data['sms_unverify'] = User::where('sms_verify', 0)->count();
        $data['balance'] = User::sum('balance') + 0;

        $data['payments'] = Deposit::where('status', 1)->sum('amount') + 0;
        $data['pending_payments'] = Deposit::where('status', 2)->sum('amount') + 0;
        $data['reject_payments'] = Deposit::where('status', 3)->sum('amount') + 0;
        $data['payment_number'] = Deposit::where('status', 1)->count();
        $data['pending_payment_number'] = Deposit::where('status', 2)->count();
        $data['reject_payment_number'] = Deposit::where('status', 3)->count();

        $data['withdrawals'] = Withdrawal::where('status', 1)->sum('amount') + 0;
        $data['pending_withdrawals'] = Withdrawal::where('status', 2)->sum('amount') + 0;
        $data['reject_withdrawals'] = Withdrawal::where('status', 3)->sum('amount') + 0;

        $data['withdrawal_number'] = Withdrawal::where('status', 1)->count();
        $data['pending_withdrawal_number'] = Withdrawal::where('status', 2)->count();
        $data['reject_withdrawal_number'] = Withdrawal::where('status', 3)->count();


        $data['total_invest'] = Invest::sum('amount') + 0;
        $data['today_invest'] = Invest::whereDate('created_at', \Carbon\Carbon::today()->toDateTimeString())->sum('amount');
        $data['yesterday_invest'] = Invest::whereDate('created_at', Carbon::yesterday()->toDateTimeString())->sum('amount');
        $data['last_7_day_invest'] = Invest::whereDate('created_at', '>=', Carbon::today()->subDays(6)->toDateTimeString())->sum('amount');
        $data['this_month_invest'] = Invest::whereDate('created_at', '>=',  Carbon::today()->subDays(29)->toDateTimeString())->sum('amount');



        $data['total_interest_return'] = Trx::where('remark', 'interest')->sum('amount');
        $data['today_interest_return'] = Trx::where('remark', 'interest')->whereDate('created_at', \Carbon\Carbon::today()->toDateTimeString())->sum('amount');
        $data['yesterday_interest_return'] = Trx::where('remark', 'interest')->whereDate('created_at', Carbon::yesterday()->toDateTimeString())->sum('amount');
        $data['last_7_day_interest_return'] = Trx::where('remark', 'interest')->whereDate('created_at', '>=', Carbon::today()->subDays(6)->toDateTimeString())->sum('amount');
        $data['this_month_interest_return'] = Trx::where('remark', 'interest')->whereDate('created_at', '>=',  Carbon::today()->subDays(29)->toDateTimeString())->sum('amount');

        $data['ref_com'] = Trx::where('remark', 'ref_com')->sum('amount');



        return view('admin.dashboard', $data);
    }





    public function profile()
    {
        $page_title = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_profile.index', compact('page_title', 'admin'));
    }

    public function passwordChange()
    {
        $page_title = 'Change Password';
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_profile.password', compact('page_title', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);
        $user = Auth::guard('admin')->user();
        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = upload_image($request->image, config('constants.admin.profile.path'), config('contants.admin.profile.size'), $old);
            } catch (\Exception $exp) {
                return back()->with('success',' cant upload image');

            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return back()->with('success',' Updated Successfully');

    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',

        ]);
        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['Password Do not match !!']);
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Password Changed Successfully');
    }

}


function month()
{
    return [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];
}

