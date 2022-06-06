<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\BranchGroupLang;
use App\Models\Lang;
use Illuminate\Http\Request;

class AdminBranchGroupController extends Controller
{
    public function list()
    {



        $branchGroups = BranchGroup::get();
        return view('back.pages.branchGroup.list', compact('branchGroups'));
    }
    public function saveForm($id = null)
    {
        $branchGroups=null;

        if ($id != null) {
            $branchGroups = BranchGroup::where('id', $id)->first();
        }

        return view('back.pages.branchGroup.form', compact('branchGroups'));
    }

    public function save(Request $request)
    {
        
        if ($request->id == null) {
            $branchGroups = new BranchGroup();
        } else {
            $branchGroups = BranchGroup::findOrFail($request->id);
        }

        $branchGroups->name = $request->name;
        $branchGroups->save();
       
        return redirect()->back()->with('success', 'Popup Kaydedildi');
    }




    public function delete($id)
    {

        $search = Branch::where('branch_group_id', $id)->get();
        if (count($search) > 0) {
            return "Silme işleminin yapılabilmesi için Şubeler silinmelidir.";
        } else {

            $deletebranchGroupLang = BranchGroupLang::where('branchGroup_id', $id);
            $deletebranchGroupLang->delete();
            $deletebranchGroup = BranchGroup::findOrFail($id);
            $deletebranchGroup->delete();
            return "Silme işlemi başarı ile gerçekleşti";
        }
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $status = BranchGroup::findOrFail($id);
        if ($status->status == 1) {
            $status->status = 0;
        } else {
            $status->status = 1;
        }
        $status->save();
        return "işlem başarılı";
    }
}
