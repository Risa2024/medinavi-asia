<!--認証関連（ログイン、新規登録、パスワードリセットなど）の共通レイアウトを定義しているページ-->
<!--使用ページ：
・ログインページ
・新規登録ページ
・パスワードリセットページ
・メール確認ページ-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-noto-sans-jp antialiased h-full bg-[#F2F2F2]">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/" class="flex items-center group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-100 via-white to-sky-100 rounded-full flex items-center justify-center mr-3 overflow-hidden shadow-[0_4px_16px_rgba(14,165,233,0.12)] ring-1 ring-blue-100/80">
                        <img src="{{ asset('images/logo/logo_dark.png') }}" alt="MediNavi Asia Logo" class="w-9 h-9 object-contain opacity-100">
                    </div>
                    <span class="text-xl font-bold text-slate-800">Medi<span class="text-teal-700">Navi</span> <span class="text-teal-500">Asia</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}<!--各ページの内容（ログインフォームや登録フォームなど）が入る-->
            </div>
        </div>
    </body>
</html>
