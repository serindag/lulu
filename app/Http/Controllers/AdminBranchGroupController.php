<?php

namespace App\Http\Controllers;

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
        $branchGroupLangs = null;
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();

        if ($id != null) {
            $branchGroupLangs = BranchGroupLang::where('branchGroup_id', $id)->get();
        }
        return view('back.pages.branchGroup.form', compact('langs', 'langFirst', 'branchGroupLangs'));
    }

    public function save(Request $request)
    {
       
        if ($request->id == null) {
            foreach ($request->names as $key => $name) {
                if (!is_null($name)) {
                    $lang = Lang::where('id', $key)->first();
                    if ($lang->name == 'Türkçe') {
                        $branchGroups = new BranchGroup();
                        $branchGroups->name = $name;
                        $branchGroups->save();
                    }
                    $lastGroup = BranchGroup::orderBy('id', 'DESC')->first();
                    $branchGroupsLang = new BranchGroupLang();
                    $branchGroupsLang->lang_id = (int)$key;
                    $branchGroupsLang->branchGroup_id = $lastGroup->id;
                    $branchGroupsLang->translate = $name;
                    $branchGroupsLang->save();
                }
            }
        } else {

            

            $i = 0;
            foreach ($request->names as $name) {

                if (!is_null($name)) {
                    $branchGroupsLang = BranchGroupLang::findOrFail($request->id[$i++]);
                    $branchGroupsLang->translate = $name;
                    $branchGroupsLang->save();
                }
            }
                $lang = Lang::where('name', 'Türkçe')->first();
                    if ($lang->name == 'Türkçe') {
                        $branchGroups=BranchGroup::findOrFail($request->branchGroup_id);
                        $branchGroups->name = $request->names[$lang->id];
                        $branchGroups->save();
                    }




        }
        return redirect()->route('admin.branchGroup');
    }




    public function delete($id)
    {
        $deletebranchGroupLang = BranchGroupLang::where('branchGroup_id', $id);
        $deletebranchGroupLang->delete();
        $deletebranchGroup = BranchGroup::findOrFail($id);
        $deletebranchGroup->delete();

        return "Silme işlemi başarı ile gerçekleşti";
    }

    public function status(Request $request)
    {
        $id= $request->id;
        $status=BranchGroup::findOrFail($id);
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
