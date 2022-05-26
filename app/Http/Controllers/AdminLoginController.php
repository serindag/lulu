<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('back.pages.login.signIn');
    }

    public function login(LoginRequest $request)
    {
       if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]))
       {
        return redirect()->route('admin.dashboard');
       }

    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.singIn');
    }
}
