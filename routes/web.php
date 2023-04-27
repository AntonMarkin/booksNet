<?php

use App\Http\Controllers\CommentController;
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
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{user}/all',  [ProfileController::class, 'comments']);

Route::get('/book/{book}', [LibraryController::class, 'getBook'])->name('get_book')->middleware(\App\Http\Middleware\BookAccess::class);

Route::middleware('auth')->group(function () {
    Route::post('/comment/new', [CommentController::class, 'create'])->name('new_comment');
    Route::get('/comment/{comment}/delete', [CommentController::class, 'delete'])->name('delete_comment');
    Route::get('/comment/{comment}/answer', [CommentController::class, 'getAnswerForm'])->name('answer_form');

    Route::get('/library/{user}', [LibraryController::class, 'index'])->name('library')->middleware(\App\Http\Middleware\LibraryAccess::class);
    Route::post('/library/{id}', [LibraryController::class, 'updateOrCreateBook']);

    Route::get('/delete-book/{id}', [LibraryController::class, 'deleteBook'])->whereNumber('id')->name('delete_book');
    Route::get('/edit-book/{id}', [LibraryController::class, 'getBook'])->whereNumber('id')->name('edit_book');
    Route::post('/edit-book/{id}', [LibraryController::class, 'updateOrCreateBook'])->whereNumber('id');

    Route::get('/user/comments', [UserCommentsController::class, 'index'])->name('user_comments');
    Route::post('/user/change-access', [ProfileController::class, 'changeAccess'])->name('change_access');
    Route::post('/user/book-share', [LibraryController::class, 'bookShare'])->name('book_share');

});
