<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MediNavi アジア') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 現在地表示 -->
            <div class="bg-gray-100 mb-6 p-4 flex flex-col items-center justify-center">
                <div class="flex items-center justify-center mb-2">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-xl">あなたの現在地：タイ・バンコク</span>
                </div>
                <button class=" px-4 py-1 rounded flex items-center">
                    🔁
                </button>
            </div>

            <!-- お薬を探す -->
            <div class="mb-10">
                <h2 class="text-2xl mb-4 flex items-center">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    お薬を探す
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- 種類から検索 -->
                    <a href="{{ route('medicines.category') }}" class="bg-gray-200 p-6 rounded hover:bg-gray-300 transition">
                        <div class="text-center">
                            <h3 class="text-xl mb-4">種類から検索</h3>
                            <div class="flex justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    
                    <!-- 商品名で検索 -->
                    <a href="{{ route('medicines.search') }}" class="bg-gray-200 p-6 rounded hover:bg-gray-300 transition">
                        <div class="text-center">
                            <h3 class="text-xl mb-4">商品名で検索</h3>
                            <div class="flex justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- お役立ちコラム -->
            <!-- 非表示 -->
            <!--<div class="mb-10">
                <h2 class="text-2xl mb-4 flex items-center">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    お役立ちコラム
                </h2>
                
                <div class="bg-gray-200 p-4 rounded relative">
                    <h3 class="text-lg mb-2">「海外で食あたりになったときの応急処置」</h3>
                    <div class="flex justify-center my-4">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    </div>
                </div>
            </div>-->
            <!-- フッター -->
            <div class="text-right mb-4">
                <a href="#" class="text-gray-600 mr-4">利用規約</a>
                <a href="#" class="text-gray-600">運営者情報</a>
            </div>
        </div>
    </div>
</x-app-layout>
