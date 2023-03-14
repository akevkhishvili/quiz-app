<?php

use App\Http\Controllers\AddQuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //quizz
    Route::get('/start', [QuizController::class, 'start'])->name('start');
    Route::post('/quiz/question/submit', [QuizController::class, 'submit'])->name('quiz.question.submit');
    Route::get('/quiz/{session_id}', [QuizController::class, 'quiz_session'])->name('quiz');
    Route::get('/quiz/confirm/{user_question_id}', [QuizController::class, 'quiz_confirm'])->name('quiz.confirm');
    Route::get('/quiz/score/{session_id}', [QuizController::class, 'quiz_score'])->name('quiz.score');
});


Route::group(['middleware' => ['auth', 'is_admin']], function () {
    //question management
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
    Route::get('/question/add', [AddQuestionController::class, 'index'])->name('question.add');
    Route::post('/question/mode', [AddQuestionController::class, 'mode'])->name('question.mode');
    //binary
    Route::get('/question/binary', [AddQuestionController::class, 'binary'])->name('question.binary');
    Route::post('/question/binary/store', [AddQuestionController::class, 'binary_store'])->name('question.binary.store');
    Route::get('/question/delete', [QuestionController::class, 'delete'])->name('question.delete');
    //multichoise
    Route::get('/question/multichoice', [AddQuestionController::class, 'multichoice'])->name('question.multichoice');
    Route::post('/question/multichoice/store', [AddQuestionController::class, 'multichoice_store'])->name('question.multichoice.store');
});


require __DIR__ . '/auth.php';
