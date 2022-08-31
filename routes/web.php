<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('blogs.')
    ->controller(\App\Http\Controllers\BlogController::class)
    ->group(function () {
        Route::get('', 'list')->name('list');
    });

Route::get('posts/show/{post}', [PostController::class, 'show'])->name('posts.show');
Route::middleware(['auth'])->group(function(){
    Route::prefix('posts')->name('posts.')
        ->controller(PostController::class)
        ->group(function () {
            Route::get('', 'list')->name('list');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store')->middleware('injectUserId');
            Route::get('edit/{post}', 'edit')->name('edit')->can('update', 'post');
            Route::patch('update/{post}', 'update')->name('update')->can('update', 'post');
        });
});

