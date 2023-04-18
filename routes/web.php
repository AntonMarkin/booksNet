<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/profile/{id}', [PageController::class, 'getProfilePage'])->name('profile');

Route::post('/comment/new', [CommentsController::class, 'newComment'])->name('new_comment');
Route::get('/comment/{id}/delete', [CommentsController::class, 'deleteComment'])->name('delete_comment');
