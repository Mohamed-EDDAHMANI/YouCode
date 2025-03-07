<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidatController;

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
    return view('welcome');
});

// Autentification routs
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::post('/dashboard', [AdminController::class, 'storeQuastion'])->name('storeQuastion');
Route::put('/questions/update/{id}', [AdminController::class, 'update'])->name('questions.update');
Route::delete('/questions/delete/{id}', [AdminController::class, 'destroy'])->name('questions.delete');
Route::get('editQuestion/{id}', [AdminController::class, 'edit'])->name('editQuestion');
Route::get('createQuestion', [AdminController::class, 'createPage'])->name('createQuestion');

Route::get('quizzes/create', [AdminController::class, 'createQuize'])->name('quizzes.create');
Route::post('quizzes/store', [AdminController::class, 'quizzesStore'])->name('quizzes.store');
Route::get('quizzes/edit/{id}', [AdminController::class, 'quizzesEdit'])->name('quizzes.edit');
Route::delete('quizzes/delete/{id}', [AdminController::class, 'quizzesDelete'])->name('quizzes.delete');
Route::get('quizzes/view/{id}', [AdminController::class, 'quizzesView'])->name('quizzes.view');
Route::put('quizzes/toggleStatus/{id}', [AdminController::class, 'toggleStatus'])->name('quizzes.toggleStatus');

Route::get('welcome', [CandidatController::class, 'getWelcome'])->name('welcome');
Route::get('home', [CandidatController::class, 'getHome'])->name('home');
Route::get('ready', [CandidatController::class, 'getReady'])->name('ready');
Route::get('test', [CandidatController::class, 'getTest'])->name('test');
Route::post('quiz/submit', [CandidatController::class, 'submit_quiz'])->name('submit_quiz');
Route::get('quiz/result', [CandidatController::class, 'results'])->name('results');
Route::get('quiz/results/page', [CandidatController::class, 'resultsPage'])->name('resultsPage');
Route::get('question/{id}', [CandidatController::class, 'getQestion'])->name('getQuestion');
Route::get('rendez-vous/create', [CandidatController::class, 'rendezVousPage'])->name('rendez-vous.create');