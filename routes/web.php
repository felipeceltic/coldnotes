<?php

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
    return view('welcome');
});

Route::get('/create', function () {
    return view('createpost');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Blog
Route::get('/blog/posts')->name('blog.myposts')->uses('BlogController@myPosts')->middleware(['auth']);
Route::get('/blog/create')->name('blog.create')->uses('BlogController@create')->middleware(['auth']);
Route::post('/blog/store')->name('blog.store')->uses('BlogController@store')->middleware(['auth']);
Route::get('/blog/edit/{post}')->name('blog.edit')->uses('BlogController@edit')->middleware(['auth']);
Route::post('/blog/update/{post}')->name('blog.update')->uses('BlogController@update')->middleware(['auth']);
