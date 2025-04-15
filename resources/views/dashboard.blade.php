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
                <div class="px-4 py-3 cursor-pointer border-b-[3px] border-blue-500 text-blue-500">ホーム</div>
                <div class="px-4 py-3 cursor-pointer border-b-[3px] border-transparent hover:border-blue-500 hover:text-blue-500 transition-colors">お気に入り</div>
                <div class="px-4 py-3 cursor-pointer border-b-[3px] border-transparent hover:border-blue-500 hover:text-blue-500 transition-colors">管理画面</div>
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
                        <a href="{{ route('medicines.category') }}" class="block bg-white rounded-lg shadow-sm h-full transition-transform duration-200 hover:-translate-y-0.5">
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
                                <div class="flex justify-center mb-4">
                                    <img src="/images/medicine1.jpg" alt="薬の種類から検索" class="w-48 md:w-64 h-auto object-contain">
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
                        <a href="{{ route('medicines.search') }}" class="block bg-white rounded-lg shadow-sm h-full transition-transform duration-200 hover:-translate-y-0.5">
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
                                <div class="flex justify-center mb-4">
                                    <img src="/images/medicine2.jpg" alt="薬の種類から検索" class="w-48 md:w-64 h-auto object-contain">
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
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl shadow-sm overflow-hidden border border-blue-100">
                        <div class="relative">
                            <div class="p-6 md:p-8 flex flex-col md:flex-row items-center">
                                <!-- 左側：コンテンツ -->
                                <div class="w-full md:w-1/2 text-gray-800 z-10">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-blue-100 rounded-full p-2 mr-3">
                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-bold text-gray-800">位置情報ベースの検索</h2>
                                    </div>

                                    <div class="mb-6">
                                        <div class="inline-flex items-center bg-blue-50 rounded-full py-1.5 px-3 mb-3 border border-blue-100">
                                            <div class="h-2 w-2 bg-emerald-400 rounded-full mr-2"></div>
                                            <p class="text-base font-medium text-gray-800" id="current-location">タイ, バンコク</p>
                                        </div>
                                        <p class="text-gray-600 text-base leading-relaxed">位置情報を有効にすると、現在いる国で販売されている薬だけを検索できます。旅行先でも地域に合った薬情報にアクセスできます。</p>
                                    </div>

                                    <button class="group bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg text-sm transition-all duration-200 flex items-center justify-center">
                                        <svg class="h-4 w-4 mr-2 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                        位置情報を有効にする
                                    </button>
                                </div>

                                <!-- 右側：イラスト -->
                                <div class="w-full md:w-1/2 mt-8 md:mt-0 flex justify-center items-center">
                                    <div class="relative w-full max-w-xs">
                                        <div class="relative bg-blue-50 rounded-xl p-6 border border-blue-100">
                                            <div class="flex justify-center mb-4">
                                                <div class="relative">
                                                    <div class="absolute -inset-3 bg-blue-100 rounded-full blur-sm"></div>
                                                    <div class="relative bg-white rounded-full p-3 border border-blue-100">
                                                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space-y-3">
                                                <div class="h-1.5 bg-blue-100 rounded-full w-3/4 mx-auto"></div>
                                                <div class="h-1.5 bg-blue-100 rounded-full w-2/3 mx-auto"></div>
                                                <div class="h-1.5 bg-blue-100 rounded-full w-1/2 mx-auto"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>
