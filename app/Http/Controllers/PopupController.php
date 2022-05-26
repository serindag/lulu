<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Popup;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function list()
    {
        $langs=Lang::get();
        $langFirst=Lang::orderBy('order','asc')->first();
        $popups=Popup::get();
        return view('back.pages.popup.list',compact('langs','langFirst','popups'));
    }

    
}
