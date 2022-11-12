<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'home'])->name('homeFilter');

Route::get('/add-qustion', [QuestionController::class, 'add'])->name('add')->middleware('auth');
Route::post('/home', [QuestionController::class, 'create'])->name('create')->middleware('auth');
Route::get('/edit-question/{question}', [QuestionController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/home/{question}', [QuestionController::class, 'update'])->name('update')->middleware('auth');
Route::get('/delete-question/{question}', [QuestionController::class, 'delete'])->name('delete')->middleware('auth');


Route::get('/add-answer/{question}', [AnswerController::class, 'add'])->name('add-answer')->middleware('auth');
Route::get('/edit-answer/{answer}', [AnswerController::class, 'edit'])->name('edit-answer')->middleware('auth');
Route::get('/delete-answer/{answer}', [AnswerController::class, 'delete'])->name('delete-answer')->middleware('auth');
Route::put('/answers/{answer}', [AnswerController::class, 'update'])->name('update-answer')->middleware('auth');
Route::get('/answers/{question}', [AnswerController::class, 'show'])->name('answers');
Route::post('/answers', [AnswerController::class, 'create'])->name('create-answer')->middleware('auth');
