<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        //dd(Auth::user()->id);
        $user_id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'usermsg'=> 'required'
        ]);
        // $request->validate([
        //     'usermsg'=>'required',
        // ]);

        
        if ($validator->fails()) {
            //dd($validator);

            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        Question::create([
            'question'=>$request->usermsg,
            'user_id'=>$user_id,
        ]);
        
        return true;
    }

    public function index()
    {
        $questions = Question::with('user')->orderBy('created_at', 'DESC')->paginate(10);
       // dd($questions);
        return view('admin_questions_index', compact('questions'))->with(request()->input('page'));
    }

    public function ajaxQuestions()
    {
        $questions = Question::with('user')->orderBy('created_at', 'DESC')->paginate(10);

        return view ('admin_questions_tab', compact('questions'))->with(request()->input('page'));
    }
}
