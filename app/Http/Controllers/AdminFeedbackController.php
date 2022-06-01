<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function list()
    {
       $feedbacks=Feedback::get();
        return view('back.pages.feedback.list',compact('feedbacks'));
    }

    public function saveform($id)
    {
        
        $feedback=Feedback::where('id',$id)->first();
        return view('back.pages.feedback.form',compact('feedback'));
    }

    public function save(Request $request)
    {
        $id=$request->id;
        $feedback=Feedback::findOrFail($id);
        $feedback->status=1;
        $feedback->save();
    }

}
