<?php

namespace App\Http\Controllers;

use App\Actions\CalculateQuizScore;
use App\Actions\CurrentQuizSession;
use App\Actions\GetQuestion;
use App\Actions\TimeLeft;
use App\Http\Requests\QuestionModeRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\UserQuestion;
use App\Models\UserQuizSession;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function start(QuestionModeRequest $request, CurrentQuizSession $getQuizSession)
    {
        $request = $request->validated();
        $session = $getQuizSession($request['question_mode_id']);
        if ($session['error']) {
            return redirect()->back()->with('error', $session['error']);
        }

        return to_route('quiz', ['session_id' => $session['quizSession']->id]);
    }

    public function submit(Request $request)
    {
        $answer = Answer::find($request->input('answer_id'));

        UserQuestion::find($request->input('user_question_id'))->update([
            'is_correct' => $answer->is_correct,
            'answer_id' => $request->input('answer_id')
        ]);

        if ($answer->is_correct) {
            return back()->with('message', "Correct! The right answer is" . " " . $answer['text']);
        }
        $correctAnswer = Answer::query()
            ->where('question_id', $answer['question_id'])
            ->where('is_correct', 1)
            ->pluck('text')
            ->first();

        return back()->with('message', "Sorry, you are wrong! The right answer is" . " " . $correctAnswer);
    }

    public function quiz_session($session_id, TimeLeft $timeLeft, GetQuestion $question, CalculateQuizScore $calculate)
    {
        $session = UserQuizSession::findOrFail($session_id);
        $timeLeft = $timeLeft($session->created_at);
        $userQuestion = $question($session->id);

        if ($timeLeft < 1 || !$userQuestion['user_question_id']) {

            $calculate($session);

            return redirect()->route('quiz.score', ['session_id' => $session->id]);
        }

        return inertia('Quiz/TakeQuiz', [
            'time_left' => $timeLeft,
            'question' => $userQuestion['question'],
            'user_question_id' => $userQuestion['user_question_id']
        ]);
    }

    public function quiz_confirm($user_question_id)
    {
        UserQuestion::find($user_question_id)->update([
            'confirmed' => 1
        ]);

        return redirect()->back();
    }

    public function quiz_score($session_id)
    {
        return inertia('Quiz/QuizScore', [
            'score' => UserQuizSession::with('User')->find($session_id)
        ]);
    }
}
