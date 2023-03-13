<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionMode;
use Illuminate\Http\Request;
use Throwable;

class QuestionController extends Controller
{
    public function index()
    {
        return inertia('Question/Index', [
            'questions' => Question::with('QuestionMode')
                ->orderBy('id', 'desc')
                ->get()
        ]);
    }

    public function delete()
    {
        try {
            Question::findOrFail(request('id'))->delete();
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', 'Question deleted');
    }
}
