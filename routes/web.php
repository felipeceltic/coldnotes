<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as AuthController;
use App\Http\Controllers\PostController as PostController;

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
// Principal routes
Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/create', [PostController::class, 'create'])->name('post.create');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/cadastro', [AuthController::class, 'cadastro'])->name('cadastro');

// Post routes

Route::post('/', [PostController::class, 'index'])->name('post');
Route::get('/postedit{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/postupdate{id}', [PostController::class, 'update'])->name('post.update');
Route::post('/poststore', [PostController::class, 'store'])->name('post.store');
Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
Route::get('posts/restore-all', [PostController::class, 'restoreAll'])->name('posts.restoreAll');
