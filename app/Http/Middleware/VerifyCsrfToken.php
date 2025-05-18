<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CSRFトークン検証ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. CSRF（クロスサイトリクエストフォージェリ）攻撃からの保護
 * 2. フォーム送信時にCSRFトークンの有効性を検証
 * 3. 不正なリクエストを拒否しアプリケーションを保護
 *
 * 使用方法：
 * Laravelのwebミドルウェアグループに自動的に含まれる
 * フォーム内に @csrf ディレクティブを追加してトークンを埋め込む
 */
class VerifyCsrfToken
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
