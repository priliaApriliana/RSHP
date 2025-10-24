<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function login()
    {
        return view('site.login');
    }

    public function process(request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        //login senderhana
        if ($username === 'admin' && $password === '123456') {
            session(['user' => $username]);
            return redirect()->route('home');
        }

        return back()->with('error', 'username atau password salah!!');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
