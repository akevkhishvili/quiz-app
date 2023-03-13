<?php

use App\Http\Controllers\AddQuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'is_admin']], function () {

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
