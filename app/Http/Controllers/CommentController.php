<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->question_id)) {
            $data = Question::where('id', $request->question_id)->with('user')->first();
        }

        if(isset($request->answer_id)) {
            $data = Answer::where('id', $request->answer_id)->with('user')->first();
        }

        return view('comment', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->payload = json_decode($request->payload);
        $user = Auth::user();
        $comment = new Comment;

        if (isset($request->payload->title)) {
            $comment->question_id = $request->payload->id;
            $question_id = $request->payload->id;
        } else {
            $comment->answer_id = $request->payload->id;
            $question_id = $request->payload->question_id;
        }

        $comment->user_id = $user->id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->to('questions/' . $question_id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    // public function destroy($id)
    // {
    //     //
    // }
}
