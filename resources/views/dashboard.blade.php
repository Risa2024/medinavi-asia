<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center mr-2">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <span class="logo-text text-gray-800 text-xl">MediNavi <span class="text-blue-500">Asia</span></span>
            </div>
            <nav class="hidden md:flex">
                <div class="nav-item active">ホーム</div>
                <div class="nav-item">お気に入り</div>
                <div class="nav-item">管理画面</div>
            </nav>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50">
        <main class="px-4 py-8">
            <!-- 検索セクション -->
            <section class="mb-12">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center">
                        <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h1 class="text-2xl font-bold text-gray-800">お薬を探す</h1>
                    </div>
                    <p class="text-gray-600 mt-2">カテゴリや商品名から探す方法を選んでください。</p>
                </div>

                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <!-- 種類から検索 -->
                        <a href="{{ route('medicines.category') }}" class="bg-white rounded-lg shadow-sm search-card">
                            <div class="p-5 flex flex-col h-full">
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3 mr-4">
                                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <h2 class="font-semibold text-gray-800 text-lg">種類から検索</h2>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4">頭痛薬、風邪薬などカテゴリで薬を探せます。症状からぴったりの薬を見つけましょう。</p>
                                <div class="mt-auto">
                                    <div class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg text-sm transition flex items-center justify-center">
                                        カテゴリから探す
                                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- 商品名で検索 -->
                        <a href="{{ route('medicines.search') }}" class="bg-white rounded-lg shadow-sm search-card">
                            <div class="p-5 flex flex-col h-full">
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 bg-green-100 rounded-lg p-3 mr-4">
                                        <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <h2 class="font-semibold text-gray-800 text-lg">商品名で検索</h2>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4">薬の名前がわかっている場合は、商品名で直接検索できます。正確かつ素早く薬を見つけられます。</p>
                                <div class="mt-auto">
                                    <div class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg text-sm transition flex items-center justify-center">
                                        商品名で検索
                                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <!-- 現在地・位置情報セクション -->
            <section class="mb-12">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="bg-blue-100 rounded-full p-2 mr-3">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-semibold text-gray-800 text-lg">現在地</h2>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 bg-blue-50">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="mb-4 md:mb-0">
                                    <p class="text-gray-800 font-medium text-lg mb-1" id="current-location">タイ, バンコク</p>
                                    <p class="text-gray-600">位置情報を有効にすると、現在いる国で販売されている薬だけを検索できます</p>
                                </div>
                                <button class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg text-sm transition flex items-center justify-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                    位置情報を有効にする
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- フッター -->
        <footer class="bg-white px-4 py-6 mt-8 border-t border-gray-200">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between">
                <div class="flex space-x-4 mb-4 md:mb-0">
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm">利用規約</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm">プライバシーポリシー</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 text-sm">運営者情報</a>
                </div>
                <div class="text-gray-600 text-sm">
                    © 2025 MediNavi Asia. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <style>
        .nav-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }
        .nav-item.active {
            border-bottom-color: #3b82f6;
            color: #3b82f6;
        }
        .search-card {
            transition: transform 0.2s;
            height: 100%;
        }
        .search-card:hover {
            transform: translateY(-2px);
        }
    </style>
</x-app-layout>
