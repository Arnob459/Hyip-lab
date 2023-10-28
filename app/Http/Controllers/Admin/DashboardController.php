<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class DashboardController extends Controller
{
    //
    public function Index(){
       $data['page_title'] = 'Dashboard';
       $data['all_users'] = User::count();

        return view('admin.dashboard',$data);
    }


}
