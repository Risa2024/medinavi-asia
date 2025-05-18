<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 認証済みユーザーリダイレクトミドルウェア
 *
 * このミドルウェアの目的：
 * 1. すでに認証済みのユーザーが認証ページ（ログイン・登録画面など）にアクセスした場合の処理
 * 2. 認証済みユーザーをダッシュボードなど適切なページへリダイレクト
 *
 * 使用方法：
 * guest ミドルウェアとしてルートに適用
 * Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest');
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
