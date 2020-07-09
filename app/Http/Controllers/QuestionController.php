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
        $user = Auth::user();
        $question = Question::where('id', $id)
                      ->with([
                          'user',
                          'comments.user',
                          'upvotes',
                          'downvotes'
                      ])
                      ->first();

        $answers = Answer::where('question_id', $id)
                      ->with([
                          'user',
                          'comments.user',
                          'upvotes',
                          'downvotes'
                      ])
                      ->get();

        $button_status = "";

        if($user->id == $question->user_id) {
            $button_status = "disabled";
        }

        $payload = [
            'question' => $question,
            'answers' => $answers,
            'user' => $user,
            'button_status' => $button_status
        ];

        return view('questions.id', $payload);
    }

    public function edit($id)
    {
        $question = Question::where('id', $id)->first();

        return view('questions.edit', ['question' => $question]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        $question->title = $request->title;
        $question->content = $request->content;
        $question->save();

        return redirect()->to('questions/' . $id);
    }

    // this function are optional
    // public function destroy($id)
    // {
    //     //
    // }
}
