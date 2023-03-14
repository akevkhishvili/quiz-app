<?php

namespace App\Actions;

use App\Models\Question;
use App\Models\UserQuestion;
use App\Models\UserQuizSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CurrentQuizSession
{
    public function __invoke($quiz_mode_id): array
    {
        $quizSession = UserQuizSession::query()
            ->where('user_id', Auth::user()->id)
            ->where('created_at', '>', Carbon::now()->subMinutes(5))
            ->orderBy('id', 'DESC')
            ->first();

        if (!$quizSession) {
            $questions = Question::query()
                ->where('question_mode_id', $quiz_mode_id)
                ->inRandomOrder()
                ->limit(10)
                ->get();

            if ($questions->count() < 10) {
                return [
                    'error' => 'not enough questions',
                    'quizSession' => null
                ];
            }

            $quizSession = UserQuizSession::create([
                'user_id' => Auth::user()->id,
            ]);

            foreach ($questions as $question) {
                UserQuestion::create([
                    'user_quiz_session_id' => $quizSession->id,
                    'user_id' => Auth::user()->id,
                    'question_id' => $question->id
                ]);
            }
        }
        return [
            'error' => null,
            'quizSession' => $quizSession
        ];

    }
}
