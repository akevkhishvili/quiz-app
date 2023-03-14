<?php

namespace App\Actions;

use App\Models\UserQuestion;

class CalculateQuizScore
{
    public function __invoke($session): void
    {
        $user_question = UserQuestion::query()
            ->where('user_quiz_session_id', $session->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        $total_quiz_time = $user_question[0]->updated_at->diffInSeconds($session->created_at);
        $unanswered_questions = $user_question->whereNull('answer_id')->count();
        $total_score = $user_question->where('is_correct', 1)->count();

        $session->update([
            'total_correct_answers' => $total_score,
            'unanswered_questions' => $unanswered_questions,
            'total_quiz_time' => $total_quiz_time
        ]);
    }
}
