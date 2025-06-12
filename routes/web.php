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

Route::resource('posts', PostController::class)->except(['index']);



/******************************************
 * ログイン認証用ルート
 * *************************************** */

// Breezeの認証ルートを読み込む
require __DIR__.'/auth.php';

// マイページ編集用ルートを読み込む
// require __DIR__.'/profile.php';

Route::get('/dashboard', function () {
    $posts = Post::where('user_id', auth()->id())->get(); // 個人の投稿のみ表示
    return view('dashboard', ['posts' => $posts]);
})->middleware(['auth'])->name('dashboard');


Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::get('/logout-test', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
});

