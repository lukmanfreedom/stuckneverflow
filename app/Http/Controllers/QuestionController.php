<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\User;
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

        $selected_answer = Answer::where('id', $question->selected_answer)
                              ->with([
                                  'user',
                                  'comments.user',
                                  'upvotes',
                                  'downvotes'
                              ])
                              ->first();

        $payload = [
            'question' => $question,
            'answers' => $answers,
            'selected_answer' => $selected_answer,
            'user' => $user
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

        if(isset($request->answer)) {
            $request->answer = json_decode($request->answer);

            if($question->selected_answer == null) {
                $selected_answer = $request->answer->id;
                $point = 15;
            } else {
                $selected_answer = null;
                $point = -15;
            }

            $question->selected_answer = $selected_answer;
            $question->save();

            $owner = User::find($request->answer->user_id);
            $owner->reputation += $point;
            $owner->save();

        } else {
            $question->title = $request->title;
            $question->content = $request->content;
            $question->save();
        }

        return redirect()->to('questions/' . $id);
    }
}
