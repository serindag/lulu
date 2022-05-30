<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TopCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function list()
    {

        $categories=Category::root()->get();


        return view('back.pages.category.list',compact('categories'));
    }

    public function order(Request $request)
    {
      /* return response()->json($request->data,200);  */
        foreach ($request->data as $key=> $data)
        {
            $save=Category::findOrFail($data->id);
            $save->order = $key+1;
            $save->save();
            foreach($data as $update)
            {
                if(!is_array($update))
                {
                    $save=Category::findOrFail($update);
                    $save->order=$key+1;
                    $save->save();
                }else {
                    

                }



            }


       }
      return "İşlem Başarılı";
    }
}
