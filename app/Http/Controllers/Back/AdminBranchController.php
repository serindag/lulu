<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AdminBranchRequest;
use App\Models\Branch;
use App\Models\BranchGroup;
use Illuminate\Http\Request;

class AdminBranchController extends Controller
{
    public function list()
    {
        $branchs =Branch::get();
        return view('back.pages.branch.list',compact('branchs'));
    }
    public function saveform($id=null)
    {
        $branchs=null;
        $branchGroups=BranchGroup::all();
        if ($id != null) {
            $branchs = Branch::where('id', $id)->first();

        }

        return view('back.pages.branch.form',compact('branchGroups','branchs'));

    }
    public function save(AdminBranchRequest $request)
    {
       
        

        if ($request->id == null) {
            $branchs=new Branch();
        }
        else
        {
            $branchs=Branch::findOrFail($request->id);
        }

        $branchs->name=$request->name;
        $branchs->city=$request->city;
        $branchs->address=$request->address;
        $branchs->telephone=$request->telephone;
        $branchs->fax=$request->fax;
        $branchs->email=$request->email;
        $branchs->service_start=$request->service_start;
        $branchs->service_end=$request->service_end;
        $branchs->branch_group_id=$request->branch_group_id;
        $branchs->save();
        return redirect()->route('admin.branch.list');

    }

    public function delete($id)
    {
        $deletebranch = Branch::findOrFail($id);
        $deletebranch->delete();
        return "Silme işlemi başarı ile gerçekleşti";
    }

    public function status(Request $request)
    {
        $id= $request->id;
        $status=Branch::findOrFail($id);
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
}
