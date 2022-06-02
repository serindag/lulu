<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AdminProductRequest;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Product;
use App\Models\ProductLang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
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
        $productLangs = null;
        $product=null;
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $categories=Category::get();
        $branches=Branch::get();

        if ($id != null) {
            
            $product=Product::where('id',$id)->first();
            $productLangs = ProductLang::where('product_id', $id)->get();
            
        }
        return view('back.pages.product.form', compact('langs', 'langFirst', 'productLangs','product','categories','branches'));

    }


    public function save(AdminProductRequest $request)
    {

        if($request->names[1]==null)
        {
            return redirect()->back()->withErrors('Türkçe başlık boş bırakılamaz');
        }

        if($request->descriptions[1]==null)
        {
            return redirect()->back()->withErrors('Türkçe açıklama boş bırakılamaz');
        }

        $langs=Lang::get();
        $name=$request->names;
        $description=$request->descriptions;
        
       
        
        if ($request->id == null) {
            

            for($i=0;$i<count($langs);$i++)
            {
                if (!is_null($name[$langs[$i]->id])) {
                    if ($langs[$i]->name == 'Türkçe') {
                        $products=new Product();
                        $products->name=$name[$langs[$i]->id];
                        $products->description=$description[$langs[$i]->id];
                        $products->branch_id = $request->branch_id;
                        $products->category_id = $request->category_id;
                        $products->price=$request->price;
                        if($request->hasFile('image')){
                            $imageName=Str::slug($name[$langs[$i]->id],'-').'.'.$request->image->getClientOriginalExtension();
                            $request->image->move(public_path('dist/assets/media/product'),$imageName);
                            $products->image='dist/assets/media/product/'.$imageName;
                
                        }
                        $products->save();
                    }
                    $lastGroup = Product::orderBy('id', 'DESC')->first();
                    $productLang = new ProductLang();
                    $productLang->lang_id=$langs[$i]->id;
                    $productLang->product_id=$lastGroup->id;
                    $productLang->translate_name=$name[$langs[$i]->id];
                    $productLang->translate_description=$description[$langs[$i]->id];
                    $productLang->save();

                }

            }
        
        } else {

           
            
            for($i=0;$i<count($langs)-1;$i++) {
              
                if (!is_null($name)) {
                   
                 
                    $productLang1 = ProductLang::where('product_id',$request->product_id)->get();
                    $productLang = ProductLang::findOrFail($productLang1[$i]->id);
                
                    $productLang->translate_name=$name[$langs[$i]->id];
                    $productLang->translate_description=$description[$langs[$i]->id];
                    $productLang->save();
                    
                }

            }

            
           
          
                $lang = Lang::where('name', 'Türkçe')->first();
                    if ($lang->name == 'Türkçe') {
                        $products=Product::findOrFail($request->product_id);
                        $products->name=$name[$langs[$i]->id];
                        $products->description=$description[$langs[$i]->id];
                        $products->branch_id = $request->branch_id;
                        $products->category_id = $request->category_id;
                        $products->price=$request->price;
                        if($request->hasFile('image')){
                            $imageName=Str::slug($name[$langs[$i]->id],'-').'.'.$request->image->getClientOriginalExtension();
                            $request->image->move(public_path('dist/assets/media/product'),$imageName);
                            $products->image='dist/assets/media/product/'.$imageName;
                
                        }
                        $products->save();
                    }

        }
        return redirect()->route('admin.category.branch');
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
