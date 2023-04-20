<?php

use App\Http\Controllers\UserCommentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{id}/all',  [ProfileController::class, 'getAllComments']);

Route::middleware('auth')->group(function () {
    Route::get('/user/comments', [UserCommentsController::class, 'index'])->name('user_comments');
    Route::post('/comment/new', [ProfileController::class, 'newComment'])->name('new_comment');
    Route::get('/comment/{id}/delete', [ProfileController::class, 'deleteComment'])->name('delete_comment');
    Route::get('/comment/{id}/answer', [ProfileController::class, 'getAnswerForm'])->name('answer_form');
});
