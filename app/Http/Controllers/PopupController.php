<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Popup;
use App\Models\PopupLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PopupController extends Controller
{
    public function list()
    {
        $langs=Lang::get();
        $langFirst=Lang::orderBy('order','asc')->first();
        $popups=Popup::where('branch_id',Auth::user()->branch_id)->get();
        return view('branch.pages.popup.list',compact('langs','langFirst','popups'));
    }

    public function saveform($id = null)
    {
        $popupLangs = null;
        $popup=null;
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $categories=Category::get();
        $branches=Branch::get();

        if ($id != null) {
            $popup=Popup::where('id',$id)->first();
            if($popup['branch_id']!=Auth::user()->branch_id)
            {
                return redirect()->back()->withErrors('Yetkisiz giriş');
            }
            
            $popupLangs = PopupLang::where('popup_id', $id)->get();
        }
        return view('branch.pages.popup.form', compact('langs', 'langFirst', 'popupLangs','popup','categories','branches'));
        
    }

    public function save(Request $request)
    {
        
        if ($request->id == null) {
            foreach ($request->names as $key => $name) {
                if (!is_null($name)) {
                    $lang = Lang::where('id', $key)->first();
                    if ($lang->name == 'Türkçe') {
                        $popups = new Popup();
                        $popups->description = $name;
                        $popups->branch_id = Auth::user()->branch_id;
                        $popups->category_id = $request->category_id;
                        $popups->date_start = $request->date_start;
                        $popups->date_end = $request->date_end;
                        $popups->save();
                    }
                   
                    $lastGroup = Popup::orderBy('id', 'DESC')->first();
                    $popupLang = new PopupLang();
                    $popupLang->lang_id = (int)$key;
                    $popupLang->popup_id = $lastGroup->id;
                    $popupLang->translate = $name;
                    $popupLang->save();
                }
            }
        } else {

            $i = 0;
            
            foreach ($request->names as $name) {
              
                if (!is_null($name)) {
                   
                    $popupLang = PopupLang::findOrFail($request->id[$i++]);
                    $popupLang->translate = $name;
                    $popupLang->save();
                }
            }
            
            
          
                $lang = Lang::where('name', 'Türkçe')->first();
                    if ($lang->name == 'Türkçe') {
                        $popups=Popup::findOrFail($request->popup_id);
                        $popups->description = $request->names[$lang->id];
                        $popups->branch_id = Auth::user()->branch_id;
                        $popups->category_id = $request->category_id;
                        $popups->date_start = $request->date_start;
                        $popups->date_end = $request->date_end;
                        $popups->save();
                    }

        }
        return redirect()->route('user.popup.list');
    }

    public function status(Request $request)
    {
        $id= $request->id;
        
        $status=Popup::findOrFail($id);

        if($status['branch_id']==Auth::user()->branch_id)
        {
            if($status->status==1)
            {
                $status->status=0;

            }else
            {
                $status->status=1;
            }
            $status->save();
            return "işlem başarılı";
        }else
        {
            return "Yetkisiz Giriş";
        }

        
    }

    public function delete($id)
    {
        $deletepopup = Popup::findOrFail($id);
        if($deletepopup['branch_id']==Auth::user()->branch_id)
        {
            $deletepopupLang = PopupLang::where('popup_id', $id);
            $deletepopupLang->delete();
            $deletepopup->delete();
            return "Silme işlemi başarı ile gerçekleşti";
        }else
        {
            return "Yetkisiz Giriş";
        }
       

        
    }

    
}
