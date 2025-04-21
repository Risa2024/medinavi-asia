<x-app-layout>
    <div class="py-6 bg-[#F2F2F2] min-h-screen">
        <div class="max-w-[1280px] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-[#0B1E26] flex items-center">
                    <span>薬のカテゴリー一覧</span>
                </h1>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($sortedCategories as $category)
                        <a href="{{ route('medicines.index', ['category' => $category]) }}" 
                           class="flex items-center justify-between px-4 py-3 bg-[#F2F2F2] text-[#0B1E26] rounded-lg border border-[#A0D3D9]/30 hover:bg-white hover:shadow-md transition-all duration-200">
                            <span class="font-medium">{{ $category }}</span>
                            <svg class="w-5 h-5 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endforeach
                </div>

                <div class="flex justify-center space-x-4 mt-8">
                    <a href="{{ route('medicines.search') }}" 
                       class="flex items-center px-5 py-2.5 bg-[#F2F2F2] text-[#0B1E26] rounded-lg border border-[#A0D3D9]/30 hover:bg-white hover:shadow-md transition-all duration-200">
                        <svg class="w-5 h-5 mr-2 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        商品名で検索
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