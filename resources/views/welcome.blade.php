<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MediNavi Asia') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-50">
            <!-- ヘッダー -->
            <header class="bg-gradient-to-r from-teal-600 to-emerald-500 shadow">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between h-auto sm:h-16 py-3 sm:py-0">
                        <div class="flex items-center justify-between sm:justify-start">
                            <div class="flex-shrink-0 flex items-center">
                                <a href="/" class="flex items-center group">
                                    <div class="w-10 sm:w-12 h-10 sm:h-12 bg-white rounded-full flex items-center justify-center mr-3 overflow-hidden">
                                        <img src="{{ asset('images/logo/logo_dark.png') }}" alt="MediNavi Asia Logo" class="w-8 sm:w-9 h-8 sm:h-9 object-contain opacity-100">
                                    </div>
                                    <span class="text-lg sm:text-xl font-bold text-white">Medi<span class="text-blue-100">Navi</span> <span class="text-sky-100">Asia</span></span>
                                </a>
                            </div>
                            <!-- モバイルメニューボタン -->
                            <button class="sm:hidden text-white/90 hover:text-white" onclick="toggleMenu()">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- ナビゲーションメニュー -->
                        <div id="mobile-menu" class="hidden sm:flex sm:items-center sm:space-x-6 mt-4 sm:mt-0">
                            <a href="#features" class="block sm:inline-block text-white/90 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">特徴</a>
                            <a href="#about" class="block sm:inline-block text-white/90 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">サービス概要</a>
                            <a href="{{ route('login') }}" class="block sm:inline-block text-white/90 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">ログイン</a>
                            <a href="{{ route('register') }}" class="block sm:inline-block bg-white/20 text-white hover:bg-white/30 px-4 py-2 rounded-md text-sm font-medium shadow-md hover:shadow-lg transition-all duration-300">新規登録</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ヒーローセクション -->
            <section class="bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
                    <div class="flex flex-col md:flex-row items-center md:justify-between gap-12 md:gap-16">
                        <div class="w-full md:w-1/2 text-center md:text-left">
                            <span class="inline-block px-4 py-1.5 text-sm font-semibold bg-teal-50 text-teal-600 rounded-full mb-6 sm:mb-8">アジアの市販薬情報をもっと身近に</span>
                            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight mb-6 sm:mb-8 text-slate-800">
                                MediNavi Asia
                            </h1>
                            <p class="text-xl text-slate-600 mb-8 sm:mb-10 leading-relaxed">
                                アジア各国で販売されている市販薬の情報を簡単に検索・比較。
                                旅行先でも安心して市販薬を探せるプラットフォームです。
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-teal-600 to-emerald-500 text-white hover:from-teal-700 hover:to-emerald-600 font-semibold px-8 py-4 rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105 text-center text-lg">
                                    無料で始める
                                    <svg class="ml-2 -mr-1 h-5 w-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                                <a href="#features" class="border-2 border-teal-200 text-teal-600 px-8 py-4 rounded-lg hover:bg-teal-50 transition-all text-center text-lg">
                                    詳しく見る
                                </a>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-teal-100 to-emerald-100 rounded-2xl transform rotate-3 transition-transform duration-500 group-hover:rotate-0"></div>
                                <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 group-hover:shadow-3xl">
                                    <img
                                        src="/images/hero-image.jpg"
                                        alt="アプリケーションのスクリーンショット"
                                        class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="absolute -bottom-4 -right-4 bg-white rounded-full shadow-lg p-4 transform transition-transform duration-500 group-hover:scale-110">
                                    <svg class="h-10 w-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 特徴セクション -->
            <section id="features" class="bg-slate-50 py-12 sm:py-20">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12 sm:mb-16">
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-slate-800 bg-teal-100 rounded-full mb-3">特徴</span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4">より安全に、より便利に</h2>
                        <p class="text-lg sm:text-xl text-slate-600 max-w-2xl mx-auto">MediNavi Asiaが提供する主な機能をご紹介します</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        <!-- 多言語対応 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-2 bg-teal-600"></div>
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-full bg-teal-100 flex items-center justify-center transition-all duration-300 group-hover:bg-teal-200 group-hover:scale-110">
                                        <svg class="h-6 sm:h-7 w-6 sm:w-7 text-teal-600 transition-colors duration-300 group-hover:text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 ml-3">多言語対応</h3>
                                </div>
                                <p class="text-slate-600">各国の市販薬の情報を現地語と日本語で提供。言語の壁を超えて必要な情報にアクセスできます。</p>
                            </div>
                        </div>

                        <!-- 詳細な情報提供 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-2 bg-teal-600"></div>
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-full bg-teal-100 flex items-center justify-center transition-all duration-300 group-hover:bg-teal-200 group-hover:scale-110">
                                        <svg class="h-6 sm:h-7 w-6 sm:w-7 text-teal-600 transition-colors duration-300 group-hover:text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 ml-3">詳細な情報提供</h3>
                                </div>
                                <p class="text-slate-600">成分、用法、注意事項など、市販薬に関する詳細な情報を分かりやすく提供します。</p>
                            </div>
                        </div>

                        <!-- 位置情報活用 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-2 bg-teal-600"></div>
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-full bg-teal-100 flex items-center justify-center">
                                        <svg class="h-6 sm:h-7 w-6 sm:w-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 ml-3">位置情報活用</h3>
                                </div>
                                <p class="text-slate-600">現在地に基づいて、近くの薬局やその国で購入可能な市販薬を表示します。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- サービス概要セクション -->
            <section id='about' class="bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
                    <div class="flex flex-col md:flex-row items-center md:justify-between gap-8 md:gap-12">
                        <div class="w-full md:w-1/2 text-center md:text-left">
                            <span class="inline-block px-3 py-1.5 text-sm font-semibold bg-teal-50 text-teal-600 rounded-full mb-4 sm:mb-6">サービス概要</span>
                            <h2 class="text-3xl sm:text-4xl font-bold leading-tight mb-4 sm:mb-6 text-slate-800">
                                安心して市販薬を<br>探せるプラットフォーム
                            </h2>
                            <p class="text-lg text-slate-600 mb-6 sm:mb-8 leading-relaxed">
                                旅行先で体調を崩したとき、言葉の壁に阻まれることなく適切な市販薬を見つけることができます。MediNavi Asiaは、アジア各国の医薬品情報を一元化し誰もが安心して医療にアクセスできる環境を提供します。
                            </p>
                            <ul class="space-y-3 sm:space-y-4">
                                <li class="flex items-center p-3 transform transition-all duration-300 hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-base text-slate-700 ml-3 font-medium">アジア各国の市販薬情報を順次拡大中</span>
                                </li>
                                <li class="flex items-center p-3 transform transition-all duration-300 hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-base text-slate-700 ml-3 font-medium">看護師監修の安心情報</span>
                                </li>
                                <li class="flex items-center p-3 transform transition-all duration-300 hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-base text-slate-700 ml-3 font-medium">24時間365日アクセス可能</span>
                                </li>
                            </ul>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-teal-100 to-emerald-100 rounded-xl transform rotate-3 transition-transform duration-500 group-hover:rotate-0"></div>
                                <div class="relative bg-white rounded-xl overflow-hidden shadow-xl transition-all duration-500 group-hover:shadow-2xl">
                                    <img
                                        src="/images/welcome_medicine.jpg"
                                        alt="アプリのデモ画像"
                                        class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="absolute -bottom-3 -right-3 bg-white rounded-full shadow-lg p-3 transform transition-transform duration-500 group-hover:scale-110">
                                    <svg class="h-8 w-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTAセクション -->
            <section class="py-12 sm:py-16 bg-gradient-to-r from-teal-600 to-emerald-500">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row items-center md:justify-between gap-6 md:gap-8">
                        <div class="w-full md:w-2/3 text-center md:text-left">
                            <h2 class="text-2xl sm:text-3xl font-bold mb-2 text-white">アジアでの市販薬探しを、もっと簡単に。</h2>
                            <p class="text-white/90">今すぐ無料で始めましょう。登録は60秒で完了します。</p>
                        </div>
                        <div class="w-full md:w-1/3 text-center md:text-right">
                            <a href="{{ route('register') }}" class="inline-block bg-white/20 text-white hover:bg-white/30 font-semibold px-6 py-3 rounded-lg shadow-lg transition-all transform hover:scale-105">
                                無料で始める
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- フッター -->
            <footer class="bg-gradient-to-r from-teal-600 to-emerald-500">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                    <div class="flex flex-col md:flex-row items-center md:justify-between gap-6 md:gap-8">
                        <div class="text-center md:text-left">
                            <div class="flex items-center justify-center md:justify-start">
                                <a href="{{ route('dashboard') }}" class="flex items-center group">
                                <div class="w-10 sm:w-12 h-10 sm:h-12 bg-white rounded-full flex items-center justify-center mr-3 overflow-hidden">
                                    <img src="{{ asset('images/logo/logo_dark.png') }}" alt="MediNavi Asia Logo" class="w-8 sm:w-9 h-8 sm:h-9 object-contain opacity-100">
                                    </div>
                                    <span class="text-lg sm:text-xl font-bold text-white">Medi<span class="text-blue-100">Navi</span> <span class="text-sky-100">Asia</span></span>
                                </a>
                            </div>
                            <p class="mt-2 text-sm text-white/80">
                                &copy; 2024 MediNavi Asia. All rights reserved.
                            </p>
                        </div>
                        <div class="flex flex-wrap justify-center md:justify-end gap-x-6 gap-y-2">
                            <a href="#" class="text-white/80 hover:text-white text-sm">プライバシーポリシー</a>
                            <a href="#" class="text-white/80 hover:text-white text-sm">利用規約</a>
                            <a href="#" class="text-white/80 hover:text-white text-sm">お問い合わせ</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function toggleMenu() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            }
        </script>
    </body>
</html>
