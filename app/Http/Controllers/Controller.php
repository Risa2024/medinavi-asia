<?php

namespace App\Http\Controllers;

/*
# 基底コントローラー (Controller.php)

## 主な機能
- 全てのコントローラーの共通基底クラス
- 認証・バリデーション・共通ロジックの継承元

## 関連ファイル
- app/Http/Controllers/配下の各コントローラー

## 実装メモ
- 直接APIは利用しない（各コントローラーで必要に応じてAPI利用）
- Laravel標準のControllerを拡張
*/

abstract class Controller
{
    //
}
