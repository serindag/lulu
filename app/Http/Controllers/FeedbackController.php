<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function list()
    {
        $feedbacks = Feedback::where('branch_id', Auth::user()->branch_id)->get();
        return view('branch.pages.feedback.list', compact('feedbacks'));
    }

    public function saveform($id)
    {

        $feedback = Feedback::where('id', $id)->first();
        if ($feedback['branch_id'] != Auth::user()->branch_id) {
            return redirect()->back()->withErrors('Yetkisiz giriş');
        }
        return view('branch.pages.feedback.form', compact('feedback'));
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 1;
        $feedback->save();
        return redirect()->route('user.feedback.list');
    }
}
