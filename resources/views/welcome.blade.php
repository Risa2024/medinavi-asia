<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediNavi Asia - アジアの医薬品情報プラットフォーム</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <!-- ヒーローセクション -->
    <div class="relative min-h-screen bg-gradient-to-br from-blue-50 to-white">
        <!-- ナビゲーション -->
        <nav class="relative z-10 bg-white/80 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center mr-2">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-semibold">MediNavi <span class="text-blue-500">Asia</span></span>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">ダッシュボード</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">ログイン</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-md text-sm font-medium transition-colors">新規登録</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- メインコンテンツ -->
        <main class="relative">
            <!-- ヒーローセクション -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1>
                            <span class="block text-base text-blue-500 font-semibold tracking-wide uppercase">アジアの医薬品情報をもっと身近に</span>
                            <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl text-gray-900">
                                MediNavi Asia
                            </span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                            アジア各国で販売されている医薬品の情報を簡単に検索・比較。
                            旅行先でも安心して医薬品を探せるプラットフォームです。
                        </p>
                        <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left">
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 transition-colors">
                                無料で始める
                                <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                        <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                            <img class="w-full" src="/images/hero-image.jpg" alt="アプリケーションのスクリーンショット">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 特徴セクション -->
            <div class="bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-base text-blue-500 font-semibold tracking-wide uppercase">特徴</h2>
                        <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                            より安全に、より便利に
                        </p>
                        <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                            MediNavi Asiaが提供する主な機能をご紹介します
                        </p>
                    </div>

                    <div class="mt-16">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <!-- 特徴1 -->
                            <div class="pt-6">
                                <div class="flow-root bg-white rounded-lg px-6 pb-8">
                                    <div class="-mt-6">
                                        <div>
                                            <span class="inline-flex items-center justify-center p-3 bg-blue-500 rounded-md shadow-lg">
                                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">多言語対応</h3>
                                        <p class="mt-5 text-base text-gray-500">
                                            各国の医薬品情報を現地語と日本語で提供。
                                            言語の壁を超えて必要な情報にアクセスできます。
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- 特徴2 -->
                            <div class="pt-6">
                                <div class="flow-root bg-white rounded-lg px-6 pb-8">
                                    <div class="-mt-6">
                                        <div>
                                            <span class="inline-flex items-center justify-center p-3 bg-blue-500 rounded-md shadow-lg">
                                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">詳細な情報提供</h3>
                                        <p class="mt-5 text-base text-gray-500">
                                            成分、用法、注意事項など、
                                            医薬品に関する詳細な情報を分かりやすく提供します。
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- 特徴3 -->
                            <div class="pt-6">
                                <div class="flow-root bg-white rounded-lg px-6 pb-8">
                                    <div class="-mt-6">
                                        <div>
                                            <span class="inline-flex items-center justify-center p-3 bg-blue-500 rounded-md shadow-lg">
                                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">位置情報活用</h3>
                                        <p class="mt-5 text-base text-gray-500">
                                            現在地に基づいて、近くの薬局や
                                            その国で購入可能な医薬品を表示します。
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTAセクション -->
            <div class="bg-blue-500">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        <span class="block">アジアでの医薬品探しを、</span>
                        <span class="block">もっと簡単に。</span>
                    </h2>
                    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition-colors">
                                無料で始める
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- フッター -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                <div class="flex justify-center space-x-6 md:order-2">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">プライバシーポリシー</span>
                        プライバシーポリシー
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">利用規約</span>
                        利用規約
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">お問い合わせ</span>
                        お問い合わせ
                    </a>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-base text-gray-400">
                        &copy; 2024 MediNavi Asia. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
