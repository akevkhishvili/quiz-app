<?php

namespace App\Actions;

use App\Models\Question;
use App\Models\UserQuestion;
use Illuminate\Support\Facades\Auth;

class GetQuestion
{
    public $user_question_id;
    public $question;

    public function __invoke($session_id): array
    {
        $user_question = UserQuestion::query()
            ->where('user_quiz_session_id', $session_id)
            ->where('user_id',Auth::user()->id)
            //->whereNull('answer_id')
            ->whereNull('confirmed')
            ->first();
        //dd($user_question);

        if($user_question){
            $this->user_question_id = $user_question->id;
            $this->question = Question::with('answer')->find($user_question->question_id);
        }

        return [
            'user_question_id'=>$this->user_question_id,
            'question'=>$this->question
        ];

    }
}
