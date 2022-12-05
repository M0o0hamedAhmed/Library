<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //


    // get
    public function register()
    {

        return view('auth.register');
    }


    // post
    public function doRegister(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);
        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(64),

        ]);

        return redirect(route('books.paginateBooks'));
    }

    public function login()
    {
        return view('auth.login');


    }

    public function doLogin(Request $request)
    {

      /*  if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            dd($this->guard());
        }else{  dd(' user');}*/

        $is_login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if (!$is_login) {
            return redirect(route('auth.login'));

        }

        return redirect(route('books.paginateBooks'));
    }


//    protected function guard()
//    {
//        return auth()->guard('front');
//    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'));

    }
}
