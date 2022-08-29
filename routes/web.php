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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){
    Route::prefix('posts')->name('posts.')
        ->controller(\App\Http\Controllers\PostController::class)
        ->group(function () {
            Route::get('', 'list')->name('list');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('show/{post}', 'show')->name('show');
            Route::get('edit/{post}', 'edit')->name('edit')->can('update', 'post');
            Route::post('update/{post}', 'update')->name('update')->can('update', 'post');
        });
});

