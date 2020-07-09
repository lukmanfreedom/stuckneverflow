<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        return view('questions.ask');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $question = New Question;

        $question->title = $request->title;
        $question->content = $request->content;
        $question->user_id = $user->id;
        $question->save();

        return redirect()->route('home');
    }

    public function show($id)
    {
        $question = Question::where('id', $id)
                      ->with(['user', 'comments.user'])
                      ->first();

        $answers = Answer::where('question_id', $id)
                      ->with(['user', 'comments.user'])
                      ->get();

        $payload = [
            'question' => $question,
            'answers' => $answers
        ];

        return view('questions.id', $payload);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    // this function are optional
    // public function destroy($id)
    // {
    //     //
    // }
}
