import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            printUrls: true,
        }),
    ],
    // 開発サーバーの設定
    server: {
        // HMR（Hot Module Replacement）の設定
        // これにより、ファイルを変更したときにブラウザを手動で更新せずに
        // 変更が自動的に反映
        // 特定の環境で自動更新が動かない問題を解決
        hmr: {
            host: 'localhost',
        },
    },
});
