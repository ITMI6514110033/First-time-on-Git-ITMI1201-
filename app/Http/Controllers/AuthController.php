<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(Request $request){
        if($request != null){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return view('content.login');
        }
        return view('content.login');
    }

    public function checkLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/content');
        }

        return back()->withErrors([
            'email' => 'Creadentials do not match our recodes',
        ]);
    }
}
