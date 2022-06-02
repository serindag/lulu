<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AdminBranchUserRequest;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBranchUserController extends Controller
{
    public function list()
    {
        $users = User::get();
        $branchs = Branch::get();
        return view('back.pages.branchUser.list', compact('users', 'branchs'));
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $status = User::findOrFail($id);
        if ($status->status == 1) {
            $status->status = 0;
        } else {
            $status->status = 1;
        }
        $status->save();
        return "işlem başarılı";
    }

    public function saveform($id = null)
    {
        $user = null;
        $branchs = Branch::all();
        if ($id != null) {
            $user = User::where('id', $id)->first();
        }

        return view('back.pages.branchUser.form', compact('user', 'branchs'));
    }

    public function save(AdminBranchUserRequest $request)
    {


        if ($request->id == null) {

            $userControl = User::where('email', $request->email)->first();
            if ($userControl != null) {
                return redirect()->back()->withErrors('Bu mail daha önce kayıtlı');
            }

            $users = new User();
        } else {
            $userControl = User::where('email', $request->email)->first();
            $users = User::findOrFail($request->id);
            if ($userControl != null) {

                if ($request->email != $users->email) {
                    return redirect()->back()->withErrors('Bu mail daha önce kayıtlı');
                }
            }
        }

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->branch_id = $request->branch_id;

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
