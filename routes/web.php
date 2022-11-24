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
Route::get('/post/deleted', [PostController::class, 'deletedindex'])->name('post.deletedindex');
Route::get('/create', [PostController::class, 'create'])->name('post.create');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/cadastro', [AuthController::class, 'cadastro'])->name('cadastro');

// Post routes

Route::post('/', [PostController::class, 'index'])->name('post');
Route::any('/post/search', [PostController::class, 'search'])->name('post.search');
Route::get('/post/edit{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/update{id}', [PostController::class, 'update'])->name('post.update');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
Route::delete('post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::delete('posthard{id}', [PostController::class, 'harddestroy'])->name('post.hard.destroy');
Route::get('post/restore/{id}', [PostController::class, 'restore'])->name('post.restore');
Route::get('post/restore-all', [PostController::class, 'restoreAll'])->name('post.restoreAll');
