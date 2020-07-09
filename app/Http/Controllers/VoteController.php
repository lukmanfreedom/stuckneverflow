<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $model = Vote::where('user_id', $request->user_id);

        if(isset($request->answer_id)) {
            $model->where('answer_id', $request->answer_id);
        } else {
            $model->where('question_id', $request->question_id);
        }

        if($model->first() != null) {
            // delete if exist
            $model->first()->delete();
        } else {
            $vote = new Vote;
            $vote->user_id = $request->user_id;

            if(isset($request->answer_id)) {
                $vote->answer_id = $request->answer_id;
            } else {
                $vote->question_id = $request->question_id;
            }

            if($request->type == 'is_upvote') {
                $vote->is_upvote = true;
            } else {
                $vote->is_downvote = true;
            }

            $vote->save();
        }

        return redirect()->to('questions/' . $request->question_id);
    }
}
