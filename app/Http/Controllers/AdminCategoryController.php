<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\SubCategory;
use App\Models\Branch;
use App\Models\Lang;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function list()
    {
        $categories = Category::root()->orderBy('order', 'ASC')->get();

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
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $branchs = Branch::get();

        if ($id != null) {
            $categoryLangs = CategoryLang::where('category_id', $id)->get();
        }
        return view('back.pages.category.form', compact('langs', 'langFirst', 'categoryLangs', 'branchs'));
    }

    public function save(Request $request)
    {
        if ($request->id == null) {
            foreach ($request->names as $key => $name) {
                if (!is_null($name)) {
                    $lang = Lang::where('id', $key)->first();
                    if ($lang->name == 'Türkçe') {
                        $categories = new Category();
                        $categories->name = $name;
                        $categories->order = 1;
                        $categories->branch_id = $request->branch_id;
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
                $categories->save();
            }
        }
        return redirect()->route('admin.category.list');
    }
}
