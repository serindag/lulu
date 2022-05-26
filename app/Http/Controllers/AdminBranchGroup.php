<?php

namespace App\Http\Controllers;

use App\Models\BranchGroup;
use App\Models\Lang;
use Illuminate\Http\Request;

class AdminBranchGroup extends Controller
{
    public function list()
    {
        $langs=Lang::get();
        $langFirst=Lang::orderBy('order','asc')->first();
        $branchGroups=BranchGroup::get();
        return view('back.pages.branchGroup.list',compact('langs','langFirst','branchGroups'));
    }
    public function saveForm()
    {
        $langs=Lang::get();
        $langFirst=Lang::orderBy('order','asc')->first();
        return view('back.pages.branchGroup.form',compact('langs','langFirst'));
    }

    public function save(Request $request)
    {
        foreach($request->names as $key=>$name)
        {
            $branchGroups= new BranchGroup();
            $branchGroups->name=$name;
            $branchGroups->lang_id=$key;
            $branchGroups->save();
        }

        return redirect()->route('admin.branchGroup');
    }
    public function editForm($id)
    {
        $edit=BranchGroup::where('id',$id)->first();
        return view('back.pages.branchGroup.update',compact('edit'));

    }
    public function update(Request $request)
    {
        $update=BranchGroup::findOrFail($request->id);
        $update->name=$request->name;
        $update->save();
        return redirect()->route('admin.branchGroup');
    }

    public function delete($id)
    {
         $delete=BranchGroup::findOrFail($id);
        $delete->delete();
        return "Silme işlemi başarı ile gerçekleşti";
    }
}
