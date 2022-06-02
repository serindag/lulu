<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AdminCategoryRequest;
use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\SubCategory;
use App\Models\Branch;
use App\Models\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function list($id=null)
    {
        $categories = Category::root()->orderBy('order', 'ASC')->where('branch_id',$id)->get();

        return view('back.pages.category.list', compact('categories'));
    }
    public function placement(Request $request)
    {
        /*  */
        foreach ($request->data as $key => $data) {
            $update = Category::findOrFail($data['id']);
            $update->order = $key + 1;
            $update->parent_id = null;
            $update->save();
            if (isset($data['children'])) {
                foreach ($data['children'] as $key1 => $children) {

                    $childupdate = Category::findOrFail($children['id']);
                    $childupdate->order = $key1 + 1;
                    $childupdate->parent_id = $data['id'];
                    $childupdate->save();

                    if (isset($children['children'])) {

                        foreach ($children['children'] as $key2 => $child) {
                            $childupdate1 = Category::findOrFail($child['id']);
                            $childupdate1->order = $key2 + 1;
                            $childupdate1->parent_id = $children['id'];
                            $childupdate1->save();
                        }
                    }
                }
            }
        }
        return $request->data;
    }
    public function saveform($id = null)
    {
        

        $categoryLangs = null;
        $category=null;
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $branchs = Branch::get();

        if ($id != null) {
            $category=Category::where('id',$id)->first();
            $categoryLangs = CategoryLang::where('category_id', $id)->get();
        }
        return view('back.pages.category.form', compact('langs', 'langFirst', 'categoryLangs', 'branchs','category'));
    }

    public function save(AdminCategoryRequest $request)
    {
        if($request->names[1]==null)
        {
            return redirect()->back()->withErrors('Türkçe boş bırakılamaz');
        }
        
        if ($request->id == null) {
            foreach ($request->names as $key => $name) {

                if (!is_null($name)) {
                    $lang = Lang::where('id', $key)->first();
                    if ($lang->name == 'Türkçe') {
                        $categories = new Category();
                        $categories->name = $name;
                        $categories->branch_id = $request->branch_id;
                        if($request->hasFile('image')){
                            $imageName=Str::slug($name,'-').'.'.$request->image->getClientOriginalExtension();
                            $request->image->move(public_path('dist/assets/media/category'),$imageName);
                            $categories->image='dist/assets/media/category/'.$imageName;
                
                        }    


                        $categories->save();
                    }
                    $lastGroup = Category::orderBy('id', 'DESC')->first();
                    $categoriesLang = new CategoryLang();
                    $categoriesLang->lang_id = (int)$key;
                    $categoriesLang->category_id = $lastGroup->id;
                    $categoriesLang->translate = $name;
                    $categoriesLang->save();
                }
            }
        } else {



            $i = 0;
            foreach ($request->names as $name) {

                if (!is_null($name)) {
                    $categoriesLang = CategoryLang::findOrFail($request->id[$i++]);
                    $categoriesLang->translate = $name;
                    $categoriesLang->save();
                }
            }
            $lang = Lang::where('name', 'Türkçe')->first();
            if ($lang->name == 'Türkçe') {
                $categories = Category::findOrFail($request->category_id);
                $categories->name = $request->names[$lang->id];
                $categories->branch_id = $request->branch_id;
                if($request->hasFile('image')){
                    $imageName=Str::slug($name,'-').'.'.$request->image->getClientOriginalExtension();
                    $request->image->move(public_path('dist/assets/media/category'),$imageName);
                    $categories->image='dist/assets/media/category/'.$imageName;
        
                }
                $categories->save();
            }
        }
        return redirect()->route('admin.category.branch');
    }

    public function status(Request $request)
    {
        $id= $request->id;
        $status=Category::findOrFail($id);
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

    public function branch()
    {
        $branches=Branch::get();
        return view('back.pages.category.branch',compact('branches'));
    }
}
