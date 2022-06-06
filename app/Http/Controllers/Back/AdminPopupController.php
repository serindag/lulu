<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AdminPopupRequest;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Popup;
use App\Models\PopupLang;
use Illuminate\Http\Request;

class AdminPopupController extends Controller
{
    public function list()
    {
        $popups = Popup::get();
        return view('back.pages.popup.list', compact('popups'));
    }

    public function status(Request $request)
    {
        $id = $request->id;

        $status = Popup::findOrFail($id);
        if ($status->status == 1) {
            $status->status = 0;
        } else {
            $status->status = 1;
        }
        $status->save();
        return "işlem başarılı";
    }

    public function saveform($id = null)
    {
        $popupLangs = null;
        $popup = null;
        $langs = Lang::get();
        $langFirst = Lang::orderBy('order', 'asc')->first();
        $categories = Category::get();
        $branches = Branch::get();

        if ($id != null) {
            $popup = Popup::where('id', $id)->first();
            $popupLangs = PopupLang::where('popup_id', $id)->get();
        }
        return view('back.pages.popup.form', compact('langs', 'langFirst', 'popupLangs', 'popup', 'categories', 'branches'));
    }

    public function save(AdminPopupRequest $request)
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
                        $popups->branch_id = $request->branch_id;
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
                        $popups->branch_id = $request->branch_id;
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

    public function delete($id)
    {
        $deletepopupLang = PopupLang::where('popup_id', $id);
        $deletepopupLang->delete();
        $deletepopup = Popup::findOrFail($id);
        $deletepopup->delete();

        return "Silme işlemi başarı ile gerçekleşti";
    }
}
