<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function form()
    {

       $user= Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('back.pages.user.form',compact('user'));
    }
    public function save(UserRequest $request)
    {
        if(Auth::guard('admin')->user()->email!=$request->email)
        {
            $userControl = Admin::where('email',$request->email)->first();
            if($userControl!=null)
            {
                return redirect()->back()->withErrors('Bu mail daha önce kayıtlı'); 
            }
            
        }
        
       $userControl= Hash::check($request->lastPassword,Auth::guard('admin')->user()->password);

        if($userControl==false)
        {
            return redirect()->back()->withErrors('Kullanıcı şifresini hatalı girdiniz.');
        }

        $id=Auth::guard('admin')->user()->id;
       $adminSave=Admin::findOrFail($id);
       $adminSave->name=$request->name;
       $adminSave->email=$request->email;
       if(!is_null($request->newPassword))
       {
        $adminSave->password=Hash::make($request->newPassword);
       }
       $adminSave->save();
       return redirect()->route('admin.dashboard');


    }

}
