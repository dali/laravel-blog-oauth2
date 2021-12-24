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

Route::group(['prefix' => 'admin'], function() {
    
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/new', [PostController::class, 'create']);
    Route::get('posts/check_slug', [PostController::class, 'checkSlug'])->name('posts.checkSlug');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.new');
    Route::get('posts/show', [PostController::class, 'show']);
});

Route::resource('posts', \App\Http\Controllers\PostController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
