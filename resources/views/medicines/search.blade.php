<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品名で検索') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-4">薬の商品名で検索</h3>
                        <p class="text-gray-500 mb-6">探している薬の名前を入力してください</p>
                    </div>

                    <!-- 検索フォーム -->
                    <form action="{{ route('medicines.index') }}" method="GET" class="mb-8 max-w-md mx-auto">
                        <div class="flex flex-col sm:flex-row shadow-md rounded-lg overflow-hidden">
                            <input type="text" name="query" value="{{ $query ?? '' }}"
                                placeholder="例: ポンタール、ロキソニン、タイレノール"
                                class="border-0 px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 font-medium transition-colors">検索する</button>
                        </div>
                    </form>

                    <div class="mt-12 flex justify-center">
                        <a href="{{ route('medicines.category') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-3 rounded-lg mr-4 flex items-center transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                            カテゴリから探す
                        </a>
                        <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-3 rounded-lg flex items-center transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            トップに戻る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 