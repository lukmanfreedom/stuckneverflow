<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['title', 'content', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function answers() {
        return $this->hasMany('App\Answer', 'question_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'question_id');
    }
}
