<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

/**
 * プロキシ信頼設定ミドルウェア
 *
 * このミドルウェアの目的：
 * 1. リバースプロキシ（ロードバランサー、CDNなど）背後で動作する際の設定
 * 2. 信頼できるプロキシからのヘッダー情報を適切に処理
 * 3. クライアントの実際のIPアドレスや接続情報を正確に取得
 *
 * 使用方法：
 * グローバルミドルウェアとして自動的に適用される
 * $proxies配列に信頼するプロキシのIPアドレスを設定
 * $headers変数でプロキシヘッダーの種類を指定
 */
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
