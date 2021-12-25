<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/sign-in/github', [SocialiteController::class, 'github']);

Route::get('/sign-in/github/redirect', [SocialiteController::class, 'githubRedirect']);

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth'], function() {
    Route::get('posts/check_slug', [\App\Http\Controllers\Admin\PostController::class, 'checkSlug'])->name('posts.checkSlug');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
});

//Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
