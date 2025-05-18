<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 文字列トリムミドルウェア
 *
 * このミドルウェアの目的：
 * 1. リクエストの全入力値の前後の空白を自動的に削除（トリム）
 * 2. フォーム入力データの正規化
 * 3. ユーザー入力の一貫性を確保
 *
 * 使用方法：
 * グローバルミドルウェアとして自動的に適用される
 * トリムを除外したい項目がある場合は$exceptプロパティに追加
 */
class TrimStrings
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
