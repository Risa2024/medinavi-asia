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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 text-blue-600 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-blue-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-2 transition-transform duration-200 group-hover:scale-110">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
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
