<x-app-layout>
    <div class="py-6 bg-[#F2F2F2] min-h-screen">
        <div class="max-w-[1280px] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-[#0B1E26] flex items-center">
                    <span>薬の商品名で検索</span>
                </h1>
                <p class="mt-2 text-[#365359]">探している薬の名前を入力してください</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <!-- 検索フォーム -->
                <form action="{{ route('medicines.index') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="flex items-center">
                        <div class="flex-grow relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="query" 
                                   value="{{ $query ?? '' }}"
                                   placeholder="例: パナドール、タイレノール"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#519A96] focus:border-transparent transition-all duration-200">
                        </div>
                        <button type="submit" 
                                class="ml-4 px-6 py-3 text-sm font-semibold text-white bg-[#519A96] hover:bg-teal-600 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            検索
                        </button>
                    </div>
                </form>

                <div class="flex justify-center space-x-4 mt-12">
                    <a href="{{ route('medicines.category') }}" 
                       class="flex items-center px-5 py-2.5 bg-[#F2F2F2] text-[#0B1E26] rounded-lg border border-[#A0D3D9]/30 hover:bg-white hover:shadow-md transition-all duration-200">
                        <svg class="w-5 h-5 mr-2 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        カテゴリから探す
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-5 py-2.5 bg-[#F2F2F2] text-[#0B1E26] rounded-lg border border-[#A0D3D9]/30 hover:bg-white hover:shadow-md transition-all duration-200">
                        <svg class="w-5 h-5 mr-2 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        トップに戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>