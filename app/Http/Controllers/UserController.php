<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function form()
    {

        $user = User::where('id', Auth::user()->id)->first();
        return view('branch.pages.user.form', compact('user'));
    }
    public function save(UserRequest $request)
    {
        if (Auth::user()->email != $request->email) {
            $userControl = User::where('email', $request->email)->first();
            if ($userControl != null) {
                return redirect()->back()->withErrors('Bu mail daha önce kayıtlı');
            }
        }


        $userControl = Hash::check($request->lastPassword, Auth::user()->password);

        if ($userControl == false) {
            return redirect()->back()->withErrors('Kullanıcı şifresini hatalı girdiniz.');
        }

        $id = Auth::user()->id;
        $userSave = User::findOrFail($id);
        $userSave->name = $request->name;
        $userSave->email = $request->email;
        if (!is_null($request->newPassword)) {
            $userSave->password = Hash::make($request->newPassword);
        }
        $userSave->save();
        return redirect()->route('user.dashboard');
    }
}
