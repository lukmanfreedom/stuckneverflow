<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Auth;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $answer = new Answer;

        $answer->user_id = $user->id;
        $answer->question_id = $request->question_id;
        $answer->content = $request->content;
        $answer->save();

        return redirect()->to('questions/' . $request->question_id);
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

    public function destroy($id)
    {
        //
    }
}
