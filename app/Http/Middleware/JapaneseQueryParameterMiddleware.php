<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

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
