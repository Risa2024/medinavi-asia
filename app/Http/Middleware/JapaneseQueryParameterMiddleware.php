<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

/**
 * 日本語URLパラメータ処理ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. 日本語を含むURLパラメータが正しく処理されないエラー「The requested resource was not found」を解決
 * 2. URLエンコードされた日本語文字列を自動的に検出してデコード
 * 3. 特に/medicines*パスへのリクエストにおける検索クエリ(query)パラメータの処理
 *
 * 作成理由：
 * Laravel標準のルートリゾルバは特定の条件下で日本語のURLパラメータを正しく解釈できないため、
 * リクエスト処理の早い段階で日本語パラメータを適切にデコードする必要があった。
 *
 * 使用方法：
 * app/Http/Kernel.phpのwebミドルウェアグループに登録することで全Webリクエストに適用。
 */
class JapaneseQueryParameterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 特に日本語関連の問題が発生する可能性のあるURLに対する特別な処理
        if ($request->is('medicines*') && $request->has('query')) {
            $rawQuery = $request->input('query');

            // すでにURLデコードされているかチェック
            if (strpos($rawQuery, '%') !== false) {
                $decodedQuery = urldecode($rawQuery);

                // リクエストのクエリパラメータを置き換え
                $request->query->set('query', $decodedQuery);
            }
        }

        return $next($request);
    }
}
