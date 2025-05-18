<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 署名付きURL検証ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. 署名付きURLの有効性を検証
 * 2. URLの改ざん防止などのセキュリティ対策
 * 3. 一時的なURLアクセス（パスワードリセットリンクなど）の保護
 *
 * 使用方法：
 * signed ミドルウェアとしてルートに適用
 * Route::get('/example', [Controller::class, 'method'])->middleware('signed');
 *
 * 注意：現在は検証ロジックを実装せず、すべてのリクエストを通過させる設定
 */
class ValidateSignature
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
