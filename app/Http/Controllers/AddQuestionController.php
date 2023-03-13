<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionModeRequest;
use App\Http\Requests\StoreBinaryQuestionRequest;
use App\Http\Requests\StoreMultichoiceRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionMode;
use Illuminate\Http\Request;

class AddQuestionController extends Controller
{
    public function index()
    {
        return inertia('Question/Add', [
            'modes' => QuestionMode::all(),
        ]);
    }

    public function mode(QuestionModeRequest $request)
    {
        return redirect('question/' . QuestionMode::findOrFail($request->validated()['question_mode_id'])->name);
    }

    public function binary()
    {
        return inertia('Question/Binary');
    }

    public function multichoice()
    {
        return inertia('Question/Multichoice');
    }

    public function binary_store(StoreBinaryQuestionRequest $request)
    {
        $request = $request->validated();
        $newQuestion = Question::create([
            'question' => $request['question'],
            'question_mode_id' => $request['question_mode_id']
        ]);

        foreach ([true, false] as $condition) {
            $isCorrect = null;
            if ($request['is_correct'] == $condition) {
                $isCorrect = 1;
            }
            Answer::create([
                'question_id' => $newQuestion->id,
                'text' => json_encode($condition),
                'is_correct' => $isCorrect
            ]);
        }
        return redirect('questions')->with('success', 'new question added successfully!');
    }

    public function multichoice_store(StoreMultichoiceRequest $request)
    {
        $request = $request->validated();
        $newQuestion = Question::create([
            'question' => $request['question'],
            'question_mode_id' => $request['question_mode_id']
        ]);

        foreach (['answer_one', 'answer_two', 'answer_tree'] as $answer) {
            $isCorrect = null;
            if ($answer == $request['is_correct']) {
                $isCorrect = 1;
            }
            Answer::create([
                'question_id' => $newQuestion->id,
                'text' => $answer,
                'is_correct' => $isCorrect
            ]);
        }
        return redirect('questions')->with('success', 'new question added successfully!');
    }
}
