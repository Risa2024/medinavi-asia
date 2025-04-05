<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            function togglePriceInfo(button) {
                const content = button.nextElementSibling;
                const icon = button.querySelector('.price-toggle-icon');
                
                // コンテンツの表示/非表示を切り替え
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    content.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }

            // ページ読み込み時に実行
            document.addEventListener('DOMContentLoaded', function() {
                // すべてのトグルボタンとそのコンテンツを直接取得
                const priceToggleButtons = document.querySelectorAll('button[onclick="togglePriceInfo(this)"]');
                
                // 各ボタンのコンテンツを開く
                priceToggleButtons.forEach(function(button) {
                    const content = button.nextElementSibling;
                    const icon = button.querySelector('.price-toggle-icon');
                    
                    if (content && icon) {
                        // 初期状態では表示する
                        content.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    }
                });
            });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
