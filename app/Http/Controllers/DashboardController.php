<?php

namespace App\Http\Controllers;

use App\Models\QuestionMode;
use App\Models\UserQuizSession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'modes' => QuestionMode::all(),
            'scores' => UserQuizSession::query()
                ->with('User')
                ->whereNotNull('total_quiz_time')
                ->orderBy('total_correct_answers','desc')
                ->orderBy('total_quiz_time')
                ->get()
        ]);
    }
}
