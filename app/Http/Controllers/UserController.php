<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Lib\GoogleAuthenticator;
use App\Rules\FileTypeValidate;
use App\Models\Setting;
use App\Models\Trx;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;

class UserController extends Controller
{

    public function profile()
    {
        $page_title = 'Profile';
        return view('users.profile.index', compact('page_title'));
    }
    public function profileEdit()
    {
        $page_title = 'Profile Edit';
        return view('users.profile.profile_edit', compact('page_title'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:160',
            'email' => 'required',
            'phone' => 'required|max:20',
            'address' => 'nullable|max:160',
            'city' => 'nullable|max:160',
            'state' => 'nullable|max:160',
            'zip' => 'nullable|max:160',
            'country' => 'nullable|max:160',
            'avatar' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ]);

        $filename = auth()->user()->avatar;
        if ($request->hasFile('avatar')) {
            try {
                $path = config('constants.user.profile.path');
                $size = config('constants.user.profile.size');
                $filename = upload_image($request->avatar, $path, $size, $filename);
            } catch (\Exception $exp) {
                // $notify[] = ['success', 'Image could not be uploaded'];
                return back()->with('error', 'Image could not be uploaded');
            }
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $filename,
            'address' => [
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
            ]
        ]);
        // $notify[] = ['success', 'Your profile has been updated'];
        return back()->with('success', 'Your profile has been updated');
    }

    public function changePass()
    {
        $page_title = 'Password Change';
        return view('users.profile.password', compact('page_title'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|max:160|min:6'
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error','Your old password doesnot match');
        }
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);
        // $notify[] = ['success', 'Your password has been updated'];
        return back()->with('success', 'Your password has been updated');
    }

    public function show2faForm()
    {

        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $_SERVER['HTTP_HOST'], $secret);
        $prevcode = $user->tsc;
        $prevqr = $ga->getQRCodeGoogleUrl($user->username . '@' . $_SERVER['HTTP_HOST'], $prevcode);
        $page_title = 'Google 2FACTOR Authentication';
        return view('users.profile.2fa', compact('page_title', 'secret', 'qrCodeUrl', 'prevcode', 'prevqr'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        if ($oneCode === $request->code) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->tv = 1;
            $user->save();

            $userAgent = getIpInfo();
            send_email($user, '2FA_ENABLE', [
                'operating_system' => $userAgent['os_platform'],
                'browser' => $userAgent['browser'],
                'ip' => $userAgent['ip'],
                'time' => $userAgent['time']
            ]);
            send_sms($user, '2FA_ENABLE', [
                'operating_system' => $userAgent['os_platform'],
                'browser' => $userAgent['browser'],
                'ip' => $userAgent['ip'],
                'time' => $userAgent['time']
            ]);

            return back()->with('success', 'Google Authenticator Enabled Successfully');
        } else {
            return back()->withErrors('Wrong Verification Code');
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $ga = new GoogleAuthenticator();

        $secret = $user->tsc;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {

            $user->tsc = null;
            $user->ts = 0;
            $user->tv = 1;
            $user->save();


            $userAgent = getIpInfo();
            send_email($user, '2FA_DISABLE', [
                'operating_system' => $userAgent['os_platform'],
                'browser' => $userAgent['browser'],
                'ip' => $userAgent['ip'],
                'time' => $userAgent['time']
            ]);
            send_sms($user, '2FA_DISABLE', [
                'operating_system' => $userAgent['os_platform'],
                'browser' => $userAgent['browser'],
                'ip' => $userAgent['ip'],
                'time' => $userAgent['time']
            ]);
            return back()->withNotify('success', 'Two Factor Authenticator Disable Successfully');
        } else {
            return back()->withErrors('Wrong Verification Code');
        }
    }

    public function depositHistory()
    {
        $page_title = 'Deposit History';
        $logs = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(config('constants.table.default'));
        return view('users.deposit_history', compact('page_title', 'logs'));
    }

    public function depositDetails($trx, $id)
    {

        $data['log'] = Deposit::where('id', $id)->where('user_id', auth()->id())->where('trx', $trx)->first();
        if ($data['log']) {

            $data['page_title'] = 'Deposit Details';
            return view('users.deposit_details', $data);
        }

        return back()->withErrors('Invalid Request');


    }

    public function transactions()
    {
        $page_title = 'Transactions';
        $logs = auth()->user()->transactions()->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        return view('users.transactions', compact('page_title', 'logs'));
    }

    public function transactionsDetails($trx, $id)
    {
        $data['page_title'] = 'Transactions Details';
        $data['log'] = Trx::where('user_id', auth()->id())->where('id', $id)->where('trx', $trx)->firstOrFail();
        return view('users.transactions_single', $data);
    }

    /*
     * User Withdraw
     */

    public function withdraw()
    {
        $data['withdrawMethod'] = WithdrawMethod::whereStatus(1)->get();
        $data['page_title'] = "Withdraw Money";
        return view('users.withdraw.methods', $data);
    }


    public function withdrawSingle($slug, $id)
    {

        $data['withdrawMethod'] = WithdrawMethod::where('id', $id)->whereStatus(1)->first();
        if ($data['withdrawMethod'] != null) {
            $data['page_title'] = 'Withdraw Via ' . $data['withdrawMethod']->name;
            return view('users.withdraw.single', $data);
        }
        return back()->with('error','Invalid Request');

    }


    public function withdrawSubmit(Request $request, $id)
    {



            $general = Setting::first();

            $WithdrawMethod = WithdrawMethod::where('id', $id)->where('status', 1)->firstOrFail();

        $this->validate($request, [
            'amount' => 'required|numeric|min:0'
        ]);





        if ($request->amount < $WithdrawMethod->min_limit) {
            // $notify[] = ['error', 'Your Requested Amount is Smaller Than Minimum Amount.'];
            return back()->with('error', 'Your Requested Amount is Smaller Than Minimum Amount.');
        }


        if ($request->amount > $WithdrawMethod->max_limit) {
            // $notify[] = ['error', 'Your Requested Amount is Larger Than Maximum Amount.'];
            return back()->with('error', 'Your Requested Amount is Larger Than Maximum Amount.');
        }

        $user = User::find(auth()->id());

        if (formatter_money($request->amount) > $user->interest_balance) {
            // $notify[] = ['error', 'Your Request Amount is Larger Then Your Current Balance.'];
            return back()->with('error', 'Your Request Amount is Larger Then Your Current Balance.');
        }

        $charge = $WithdrawMethod->fixed_charge + ($request->amount * $WithdrawMethod->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = formatter_money($afterCharge * $WithdrawMethod->rate);


        $withdraw = new Withdrawal();
        $withdraw->method_id = $WithdrawMethod->id;
        $withdraw->user_id = $user->id;
        $withdraw->trx = getTrx();
        $withdraw->amount = formatter_money($request->amount);
        $withdraw->chart_amount -= formatter_money($request->amount);
        $withdraw->charge = $charge;
        $withdraw->after_charge = $afterCharge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->currency = $WithdrawMethod->currency;
        $withdraw->rate = $WithdrawMethod->rate;
        $withdraw->detail = $request->ud;
        $withdraw->status = 2;
        $withdraw->save();


        $user->balance = $user->interest_balance - $request->amount;
        $user->update();


        Trx::create([
            'user_id' => $withdraw->user_id,
            'amount' => $withdraw->amount,
            'post_balance' => $user->balance,
            'charge' => $withdraw->charge,
            'trx_type' => '-',
            'remark' => 'withdraw_request',
            'details' => 'Withdraw Via ' . $withdraw->method->name,
            'trx' => $withdraw->trx,
            'type' => 2
        ]);


        // notify($user, 'WITHDRAW_REQUEST', [
        //     'method_name' => $withdraw->method->name,
        //     'method_currency' => $withdraw->currency,
        //     'method_amount' => formatter_money($withdraw->final_amount),
        //     'amount' => formatter_money($withdraw->amount),
        //     'charge' => formatter_money($withdraw->charge),
        //     'currency' => $general->cur,
        //     'rate' => $withdraw->rate + 0,
        //     'trx' => $withdraw->trx,
        //     'post_balance' => $user->balance + 0,
        //     'delay' => $withdraw->method->delay
        // ]);

        // $notify[] = ['success', 'Withdraw Request Successfully Send'];
        return redirect()->route('user.withdraw.history')->with('success', 'Withdraw Request Successfully Send');
    }

    public function withdrawHistory()
    {
        $data['page_title'] = "Withdraw Log";
        $data['withdraws'] = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->latest()->paginate(config('constants.table.default'));
        return view('users.withdraw.log', $data);
    }

    public function withdrawDetails($trx, $id)
    {
        $data['page_title'] = "Withdraw Log";
        $data['log'] = Withdrawal::where('id', $id)->where('user_id', auth()->id())->where('trx', $trx)->where('status', '!=', 0)->with('method')->firstOrFail();
        return view('users.withdraw.withdraw_details', $data);
    }


}
