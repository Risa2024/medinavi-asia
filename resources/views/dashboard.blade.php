<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900">
                MediNavi <span class="text-blue-600">Asia</span>
            </h2>
            <p class="mt-2 text-gray-600">アジアのお薬情報をスマートに検索</p>
        </div>
    </x-slot>

    <div class="min-h-screen py-12 bg-gradient-to-b from-blue-50 to-white">
        <div class="max-w-3xl mx-auto mt-10 space-y-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-center mb-4 text-blue-900">🔍 お薬を探す</h1>
            <p class="text-center text-blue-700 mb-8">カテゴリや商品名から探す方法を選んでください。</p>

            <!-- カテゴリ検索 -->
            <a href="{{ route('medicines.category') }}" class="block group">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-4 rounded-xl">
                            <span class="text-4xl">🗂️</span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-blue-900">種類から検索</h2>
                            <p class="text-blue-700 text-sm mt-1">腹痛薬、目薬などカテゴリで探す</p>
                        </div>
                        <div class="text-blue-600 group-hover:translate-x-1 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- 商品名検索 -->
            <a href="{{ route('medicines.search') }}" class="block group">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-4 rounded-xl">
                            <span class="text-4xl">🔎</span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-blue-900">商品名で検索</h2>
                            <p class="text-blue-700 text-sm mt-1">知っている商品名で検索する</p>
                        </div>
                        <div class="text-blue-600 group-hover:translate-x-1 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- フッター -->
            <div class="flex justify-center space-x-8 text-sm text-blue-600 mt-12">
                <a href="#" class="hover:text-blue-800 transition-colors duration-200">利用規約</a>
                <a href="#" class="hover:text-blue-800 transition-colors duration-200">運営者情報</a>
            </div>
        </div>
    </div>
</x-app-layout>
