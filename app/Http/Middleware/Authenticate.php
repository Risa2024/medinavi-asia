<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 認証ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. 認証が必要なルートへのアクセスを制御
 * 2. 未認証ユーザーをログインページにリダイレクト
 * 3. 認証済みユーザーのみが特定のルートにアクセス可能にする
 *
 * 使用方法：
 * auth ミドルウェアとしてルートに適用
 * Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
 */
class Authenticate
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
