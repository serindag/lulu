<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLang;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function list($id=null)
    {
        $products=Product::where('category_id',$id)->get();
        
        return view('back.pages.product.list',compact('products'));
    }

    public function status(Request $request)
    {
        $id= $request->id;
        return "deneme";
        
        $status=Product::findOrFail($id);
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

    public function saveform($id = null)
    {
    }

    public function save(Request $request)
    {
    }

    public function delete($id)
    {
        
        $deleteproductLang = ProductLang::where('product_id', $id);
        $deleteproductLang->delete();
        $deleteproduct = Product::findOrFail($id);
        $deleteproduct->delete();

        return "Silme işlemi başarı ile gerçekleşti";
    }
}
