<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        return view('branch.pages.login.signIn');
    }

    public function login(LoginRequest $request)
    {
        $search=User::where('email',$request->email)->first();
        if($search->status==0)
        {   
            return redirect()->route('user.login.login')->withErrors('Lütfen kullancı adını ve şifresini doğru giriniz!');
        }

        $request->authenticate();
       
        $request->session()->regenerate();

        return redirect()->route('user.dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.login.login');
    }
}
