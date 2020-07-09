<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
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

    // this function are optional
    // public function destroy($id)
    // {
    //     //
    // }
}
