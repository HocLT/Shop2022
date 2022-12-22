<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function processLogin(Request $request) 
    {
        $email = $request->username;
        $pass = $request->password;
        $user = User::where('email', '=', $email)
            ->where('password', '=', $pass)->first();
       //dd($user);
        if ($user != null) {
            $request->session()->put('user', $user);
            if ($user->role_id == 1) {
                return redirect('user');
            }
        }
        return redirect('/');   // chuyển về trang index của fe
    }
}
