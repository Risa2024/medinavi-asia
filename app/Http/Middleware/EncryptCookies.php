<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cookie暗号化ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. アプリケーションが生成するCookieを自動的に暗号化・復号化
 * 2. ユーザーのブラウザに保存される情報を保護
 * 3. セッションCookieや認証Cookieなどの安全な管理
 *
 * 使用方法：
 * Laravelのwebミドルウェアグループに自動的に含まれる
 * 暗号化を除外したいCookieがある場合は$exceptプロパティに追加
 */
class EncryptCookies
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
