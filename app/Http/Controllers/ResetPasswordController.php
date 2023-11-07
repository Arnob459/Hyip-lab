<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */



    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showReset(Request $request, $token = null)
    {

        $email = session('fpass_email');
        $token = session()->has('token') ? session('token') : $token;
        if (PasswordReset::where('token', $token)->where('email', $email)->count() != 1) {
            // $notify[] = ['error', 'Invalid token'];
            return redirect()->route('user.password.request')->with('error', 'Invalid token');
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email, 'page_title' => 'Reset Password']
        );
    }

    public function reset(Request $request)
    {

        session()->put('fpass_email', $request->email);

        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        if (!$reset) {
            // $notify[] = ['error', 'Invalid Verification Code'];
            return redirect()->route('user.login')->with('error', 'Invalid Verification Code');
        }

        $user = User::where('email', $reset->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();



        $userAgent = getIpInfo();
        send_email($user, 'PASS_RESET_DONE', [
            'operating_system' => $userAgent['os_platform'],
            'browser' => $userAgent['browser'],
            'ip' => $userAgent['ip'],
            'time' => $userAgent['time']
        ]);


        // $notify[] = ['success', 'Password Changed'];
        return redirect()->route('login')->with('success', 'Password Changed');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

}
