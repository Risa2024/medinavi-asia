<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 py-3 gap-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-100 via-white to-emerald-100 rounded-full flex items-center justify-center mr-3 overflow-hidden shadow-[0_4px_16px_rgba(20,184,166,0.12)] ring-1 ring-teal-100/80">
                        <img src="{{ asset('images/logo/logo_dark.png') }}" alt="MediNavi Asia Logo" class="w-9 h-9 object-contain opacity-100">
                    </div>
                    <span class="text-xl font-bold text-slate-800">Medi<span class="text-teal-600">Navi</span> <span class="text-emerald-500">Asia</span></span>
                </div>
            </div>
            <nav class="flex items-center space-x-6 overflow-x-auto pb-2 sm:pb-0">
                <div class="text-slate-600 hover:text-teal-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 cursor-pointer border-b-[3px] border-teal-600 whitespace-nowrap">ホーム</div>
                <div class="text-slate-600 hover:text-teal-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 cursor-pointer border-b-[3px] border-transparent hover:border-teal-600 whitespace-nowrap">お気に入り</div>
                <div class="text-slate-600 hover:text-teal-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300 cursor-pointer border-b-[3px] border-transparent hover:border-teal-600 whitespace-nowrap">管理画面</div>
            </nav>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50">
        <main class="px-4 sm:px-6 lg:px-8 py-8">
            <!-- 検索セクション -->
            <section class="mb-12">
                <div class="text-center mb-8">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-slate-800 bg-teal-100 bg-opacity-80 rounded-full mb-3">お薬を探す</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4">カテゴリや商品名から探す</h2>
                    <p class="text-lg sm:text-xl text-slate-600 max-w-2xl mx-auto">検索方法を選んでください</p>
                </div>

                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                        <!-- 種類から検索 -->
                        <a href="{{ route('medicines.category') }}" class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-2 bg-gradient-to-r from-teal-600 to-emerald-500"></div>
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center mb-4 sm:mb-5">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-full bg-gradient-to-br from-teal-100 via-white to-emerald-100 flex items-center justify-center overflow-hidden shadow-[0_4px_16px_rgba(20,184,166,0.12)] ring-1 ring-teal-100/80">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 sm:h-7 w-6 sm:w-7 text-teal-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 ml-3 sm:hidden">種類から検索</h3>
                                </div>
                                <h3 class="hidden sm:block text-xl font-bold text-slate-800 mb-3">種類から検索</h3>
                                <p class="text-sm sm:text-base text-slate-600 mb-4 sm:mb-5">頭痛薬、風邪薬などカテゴリで薬を探せます。症状からぴったりの薬を見つけましょう。</p>
                                <div class="flex justify-center mb-4">
                                    <img src="/images/medicine1.jpg" alt="薬の種類から検索" class="w-36 sm:w-48 md:w-64 h-auto object-contain">
                                </div>
                                <div class="mt-4">
                                    <div class="w-full bg-gradient-to-r from-teal-600 to-emerald-500 text-white hover:from-teal-700 hover:to-emerald-600 font-medium py-2 px-4 rounded-lg text-sm transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
                                        カテゴリから探す
                                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- 商品名で検索 -->
                        <a href="{{ route('medicines.search') }}" class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-2 bg-gradient-to-r from-teal-600 to-emerald-500"></div>
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center mb-4 sm:mb-5">
                                    <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-full bg-gradient-to-br from-teal-100 via-white to-emerald-100 flex items-center justify-center overflow-hidden shadow-[0_4px_16px_rgba(20,184,166,0.12)] ring-1 ring-teal-100/80">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 sm:h-7 w-6 sm:w-7 text-teal-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 ml-3 sm:hidden">商品名で検索</h3>
                                </div>
                                <h3 class="hidden sm:block text-xl font-bold text-slate-800 mb-3">商品名で検索</h3>
                                <p class="text-sm sm:text-base text-slate-600 mb-4 sm:mb-5">薬の名前がわかっている場合は、商品名で直接検索できます。正確かつ素早く薬を見つけられます。</p>
                                <div class="flex justify-center mb-4">
                                    <img src="/images/medicine2.jpg" alt="薬の種類から検索" class="w-36 sm:w-48 md:w-64 h-auto object-contain">
                                </div>
                                <div class="mt-4">
                                    <div class="w-full bg-gradient-to-r from-teal-600 to-emerald-500 text-white hover:from-teal-700 hover:to-emerald-600 font-medium py-2 px-4 rounded-lg text-sm transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
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
                <div class="max-w-6xl mx-auto">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-2 bg-gradient-to-r from-teal-600 to-emerald-500"></div>
                        <div class="p-4 sm:p-8">
                            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-8">
                                <!-- 左側：コンテンツ -->
                                <div class="w-full md:w-1/2 text-slate-800 z-10">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-full bg-gradient-to-br from-teal-100 via-white to-emerald-100 flex items-center justify-center mb-4 sm:mb-5 overflow-hidden shadow-[0_4px_16px_rgba(20,184,166,0.12)] ring-1 ring-teal-100/80">
                                            <svg class="h-6 sm:h-7 w-6 sm:w-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-lg sm:text-xl font-bold text-slate-800 ml-4 sm:hidden">位置情報ベースの検索</h2>
                                    </div>
                                    <h2 class="hidden sm:block text-xl font-bold text-slate-800 mb-4">位置情報ベースの検索</h2>

                                    <div class="mb-6">
                                        <div class="inline-flex items-center bg-teal-100 bg-opacity-80 rounded-full py-1.5 px-3 mb-3">
                                            <div class="h-2 w-2 bg-teal-500 rounded-full mr-2"></div>
                                            <p class="text-sm sm:text-base font-medium text-slate-800" id="current-location">タイ, バンコク</p>
                                        </div>
                                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">位置情報を有効にすると、現在いる国で販売されている薬だけを検索できます。旅行先でも地域に合った薬情報にアクセスできます。</p>
                                    </div>

                                    <button class="w-full sm:w-auto bg-gradient-to-r from-teal-600 to-emerald-500 text-white hover:from-teal-700 hover:to-emerald-600 font-medium py-2 px-4 rounded-lg text-sm transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
                                        </svg>
                                        位置情報を有効にする
                                    </button>
                                </div>

                                <!-- 右側：イラスト -->
                                <div class="w-full md:w-1/2 flex justify-center items-center">
                                    <div class="relative w-full max-w-xs">
                                        <div class="relative bg-teal-100 bg-opacity-10 rounded-xl p-4 sm:p-6">
                                            <div class="flex justify-center mb-4">
                                                <div class="relative">
                                                    <div class="absolute -inset-3 bg-teal-100 bg-opacity-20 rounded-full blur-sm"></div>
                                                    <div class="relative bg-white rounded-full p-3 shadow-md">
                                                        <svg class="h-6 sm:h-8 w-6 sm:w-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space-y-2 sm:space-y-3">
                                                <div class="h-1.5 bg-teal-100 bg-opacity-30 rounded-full w-3/4 mx-auto"></div>
                                                <div class="h-1.5 bg-teal-100 bg-opacity-30 rounded-full w-2/3 mx-auto"></div>
                                                <div class="h-1.5 bg-teal-100 bg-opacity-30 rounded-full w-1/2 mx-auto"></div>
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
