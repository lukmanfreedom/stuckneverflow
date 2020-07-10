<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vote;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $model = Vote::where('user_id', $request->user_id);

        if(isset($request->answer)) {
            $request->answer = json_decode($request->answer);
            $question_id = $request->question_id;
            $owner_id = $request->answer->user_id;

            $model->where('answer_id', $request->answer->id);
        } else {
            $request->question = json_decode($request->question);
            $question_id = $request->question->id;
            $owner_id = $request->question->user_id;

            $model->where('question_id', $request->question->id);
        }

        if($model->first() != null) {
            // reset reputation point
            if($model->first()->is_upvote) {
                $point= -10;
            } else {
                $point = 1;
            }

            $owner = User::find($owner_id);
            $owner->reputation += $point;
            $owner->save();

            // delete if exist
            $model->first()->delete();
        } else {
            $vote = new Vote;
            $vote->user_id = $request->user_id;

            if(isset($request->answer)) {
                $vote->answer_id = $request->answer->id;
            } else {
                $vote->question_id = $request->question->id;
            }

            if($request->type == 'is_upvote') {
                $vote->is_upvote = true;
                $point = 10;
            } else {
                $vote->is_downvote = true;
                $point = -1;
            }

            $vote->save();

            $owner = User::find($owner_id);
            $owner->reputation += $point;
            $owner->save();
        }

        return redirect()->to('questions/' . $question_id);
    }
}
