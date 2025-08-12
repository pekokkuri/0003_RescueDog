<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()
        ->intended(route('dashboard', absolute: false))
        ->with('flashSuccess', "ようこそ、" . Auth::user()->name . " さん！");
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // ログイン成功後、マイページを表示
    public function dashboard(): View
    {
        //投稿一覧を表示
        $posts = Post::where('user_id', auth()->id())->get(); 

        // ログインユーザーの通知を取得（未読通知のみ）
        $notifications = auth()->user()->notifications()
        ->with(['comment.user', 'reply.user']) // 関連リレーションの eager loading
        ->where('is_read', false)
        ->latest()
        ->get();

        // ビューに渡す
        return view('dashboard', compact('posts', 'notifications'));
    }
}
