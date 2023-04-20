<?php

use App\Http\Controllers\UserCommentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
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

Route::get('/book/{id}', [LibraryController::class, 'getBook'])->name('get_book')->middleware(\App\Http\Middleware\BookAccess::class);

Route::middleware('auth')->group(function () {
    Route::post('/comment/new', [ProfileController::class, 'newComment'])->name('new_comment');
    Route::get('/comment/{id}/delete', [ProfileController::class, 'deleteComment'])->name('delete_comment');
    Route::get('/comment/{id}/answer', [ProfileController::class, 'getAnswerForm'])->name('answer_form');

    Route::get('/library/{id}', [LibraryController::class, 'index'])->name('library')->middleware(\App\Http\Middleware\LibraryAccess::class);

    Route::get('/user/comments', [UserCommentsController::class, 'index'])->name('user_comments');
    Route::post('/user/change-access', [ProfileController::class, 'changeAccess'])->name('change_access');
    Route::post('/user/book-share', [LibraryController::class, 'bookShare'])->name('book_share');

});
