<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;

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


/******************************************
 * 投稿用ルート
 * *************************************** */

Route::get('/', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit-post');

Route::resource('posts', PostController::class)->except(['index','edit']);

Route::post('posts/{post}/found', [PostController::class, 'found'])->name('posts.found');


/******************************************
 * ログイン認証用ルート
 * *************************************** */

// ログイン認証用ルートを読み込む
require __DIR__.'/auth.php';

