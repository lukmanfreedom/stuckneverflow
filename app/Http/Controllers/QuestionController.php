<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\User;
use App\Tag;
use App\QuestionTag;
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

        $tags = explode(',', $request->tags);

        foreach ($tags as $key => $value) {
            $value = strtolower($value);

            $model = Tag::where('name', 'like', $value)->first();

            if ($model == null) {
                $tag = new Tag;
                $tag->name = $value;
                $tag->save();

                $tag_id = $tag->id;
            } else {
                $tag_id = $model->id;
            }

            $question_tag = new QuestionTag;
            $question_tag->question_id = $question->id;
            $question_tag->tag_id = $tag_id;
            $question_tag->save();
        }

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
                          'downvotes',
                          'questionTag.tag'
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
        $question = Question::where('id', $id)->with(['questionTag.tag'])->first();
        $tags = "";

        foreach ($question->questionTag as $key) {
            $tags .= $key->tag->name . ',';
        }

        return view('questions.edit', ['question' => $question, 'tags' => $tags]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        if(isset($request->answer)) {
            // this block used to give reputation
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
            // normal update
            $question->title = $request->title;
            $question->content = $request->content;
            $question->save();

            $tags = explode(',', $request->tags);
            $question_tag = QuestionTag::where('question_id', $id)->delete();

            foreach ($tags as $key => $value) {
                $value = strtolower($value);

                $model = Tag::where('name', 'like', $value)->first();

                if ($model == null) {
                    $tag = new Tag;
                    $tag->name = $value;
                    $tag->save();

                    $tag_id = $tag->id;
                } else {
                    $tag_id = $model->id;
                }

                $question_tag = new QuestionTag;
                $question_tag->question_id = $question->id;
                $question_tag->tag_id = $tag_id;
                $question_tag->save();
            }
        }

        return redirect()->to('questions/' . $id);
    }
}
