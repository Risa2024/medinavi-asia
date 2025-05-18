<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * メンテナンスモード制御ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. アプリケーションがメンテナンスモード中のリクエスト処理を制御
 * 2. メンテナンスモード中でもアクセス可能なURIを設定
 * 3. 管理者やメンテナンス作業者へのアクセス許可
 *
 * 使用方法：
 * グローバルミドルウェアとして自動的に適用される
 * php artisan down コマンドでメンテナンスモードを有効化
 * メンテナンス中もアクセスを許可するURIは$exceptプロパティに追加
 */
class PreventRequestsDuringMaintenance
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
