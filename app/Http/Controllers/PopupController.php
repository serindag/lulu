<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\PopupRequest;
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
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $popups = Popup::where('branch_id', Auth::user()->branch_id)->get();
        return view('branch.pages.popup.list', compact('langs', 'langFirst', 'popups'));
    }

    public function saveform($id = null)
    {
        $popupLangs = null;
        $popup = null;
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $categories = Category::where('branch_id', Auth::user()->branch_id)->get();
        $branches = Branch::get();

        if ($id != null) {
            $popup = Popup::where('id', $id)->first();
            if ($popup['branch_id'] != Auth::user()->branch_id) {
                return redirect()->back()->withErrors('Yetkisiz giriş');
            }

            $popupLangs = PopupLang::where('popup_id', $id)->get();
        }
        return view('branch.pages.popup.form', compact('langs', 'langFirst', 'popupLangs', 'popup', 'categories', 'branches'));
    }

    public function save(PopupRequest $request)
    {
       


        if ($request->names[1] == null) {
            return redirect()->back()->withErrors('Türkçe başlık boş bırakılamaz');
        }

        if ($request->descriptions[1] == null) {
            return redirect()->back()->withErrors('Türkçe açıklama boş bırakılamaz');
        }

        $langs = Lang::get();
        $name = $request->names;
        $description = $request->descriptions;

        if ($request->id == null) {




            for ($i = 0; $i < count($langs); $i++) {
                if (!is_null($name[$langs[$i]->id])) {
                    if ($langs[$i]->name == 'Türkçe') {
                        $popups = new Popup();
                        $popups->name = $name[$langs[$i]->id];
                        $popups->description = $description[$langs[$i]->id];
                        $popups->branch_id = Auth::user()->branch_id;
                        $popups->category_id = $request->category_id;
                        $popups->date_start = $request->date_start;
                        $popups->date_end = $request->date_end;

                        $popups->save();
                    }
                    $lastGroup = Popup::orderBy('id', 'DESC')->first();
                    $popupLang = new PopupLang();
                    $popupLang->lang_id = $langs[$i]->id;
                    $popupLang->popup_id = $lastGroup->id;

                    $popupLang->translate_name = $name[$langs[$i]->id];
                    $popupLang->translate_description = $description[$langs[$i]->id];
                    $popupLang->save();
                }
            }
        } else {


            for ($i = 0; $i < count($langs) - 1; $i++) {

                if (!is_null($name)) {


                    $popupLang1 = PopupLang::where('popup_id', $request->popup_id)->get();
                    if (isset($popupLang1[$i]->id)) {
                        $popupLang = PopupLang::findOrFail($popupLang1[$i]->id);
                        $popupLang->translate_name = $name[$langs[$i]->id];
                        $popupLang->translate_description = $description[$langs[$i]->id];
                        $popupLang->save();
                    }
                }



                if (isset($name[$langs[$i]->id])) {

                    $lang = Lang::where('name', 'Türkçe')->first();
                    if ($lang->name == 'Türkçe') {
                        $popups = Popup::findOrFail($request->popup_id);
                        $popups->name = $name[$langs[$i]->id];
                        $popups->description = $description[$langs[$i]->id];
                        $popups->branch_id = Auth::user()->branch_id;
                        $popups->category_id = $request->category_id;
                        $popups->date_start = $request->date_start;
                        $popups->date_end = $request->date_end;
                        $popups->save();
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Popup Kaydedildi');
    }

    public function status(Request $request)
    {
        $id = $request->id;

        $status = Popup::findOrFail($id);

        if ($status['branch_id'] == Auth::user()->branch_id) {
            if ($status->status == 1) {
                $status->status = 0;
            } else {
                $status->status = 1;
            }
            $status->save();
            return "işlem başarılı";
        } else {
            return "Yetkisiz Giriş";
        }
    }

    public function delete($id)
    {
        $deletepopup = Popup::findOrFail($id);
        if ($deletepopup['branch_id'] == Auth::user()->branch_id) {
            $deletepopupLang = PopupLang::where('popup_id', $id);
            $deletepopupLang->delete();
            $deletepopup->delete();
            return "Silme işlemi başarı ile gerçekleşti";
        } else {
            return "Yetkisiz Giriş";
        }
    }
}
