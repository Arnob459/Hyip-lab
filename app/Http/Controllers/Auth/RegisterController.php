<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $newpass = Str::random(6);
        // dd($newpass);
        $refid = User::where('username',$data['refferal'])->pluck('id')->first();
        // dd($refid);
        $createusername = random_int(10000000, 99999999);

        if(User::where('username',$createusername)->exists()) {

            return $createusername;
        }
        else{
            $username = $createusername;
        }

        return User::create([
            'refferal' => $refid,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => $username,
            'password' => Hash::make($newpass),
            'password_text' =>$newpass,
            'address' => [
                'address' => '',
                'state' => '',
                'zip' => '',
                'country' => '',
                'city' => '',
            ],
            'status' => 1,
            'email_verify' =>   1,
            'sms_verify' =>   1,
            'ts' => 0,
            'tv' => 1,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $checkRef = User::where('username', $request->refferal)->first();
        if($checkRef == NULL){
        return back()->with('message', 'Invalid refferal id');
        }

        $checkemail = User::where('email', $request->email)->first();
        if($checkemail){
        return back()->with('message', 'Email already exists');
        }

        $checkphone = User::where('phone', $request->phone)->first();
        if($checkphone){
        return back()->with('message', 'phone Number Already exists');
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }
}
