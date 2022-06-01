<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBranchUserController extends Controller
{
    public function list()
    {
        $users =User::get();
        return view('back.pages.branchUser.list',compact('users'));
    }

    public function status(Request $request)
    {
        $id= $request->id;
        $status=User::findOrFail($id);
        if($status->status==1)
        {
            $status->status=0;

        }else
        {
            $status->status=1;
        }
        $status->save();
        return "işlem başarılı";
    }

    public function saveform($id=null)
    {
        $user=null;
        $branchs=Branch::all();
        if ($id != null) {
            $user = User::where('id', $id)->first();

        }

        return view('back.pages.branchUser.form',compact('user','branchs'));

    }

    public function save(Request $request)
    {
       
        if ($request->id == null) {
            $users=new User();
        }
        else
        {
            $users=User::findOrFail($request->id);
        }

        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=Hash::make($request->password);
        $users->branch_id=$request->branch_id;
        
        $users->save();
        return redirect()->route('admin.branchUser.list');
    }

    public function delete($id)
    {
        $deleteuser = User::findOrFail($id);
        $deleteuser->delete();
        return "Silme işlemi başarı ile gerçekleşti";
    }

}
