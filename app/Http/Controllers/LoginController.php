<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    function index()
    {
        return view('login.login');
    }

    function checklogin(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);

        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
        {
            return redirect('/home');
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }

    }
    public function show()
    {
        return view('login.login');
    }

    function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
