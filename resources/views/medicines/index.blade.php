<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('薬の検索結果') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- 検索条件表示 -->
                    <div class="mb-6 border-b pb-4">
                        @if(request()->has('category'))
                            <h3 class="text-xl font-semibold">カテゴリ「{{ request()->category }}」の薬</h3>
                        @endif
                        @if($query)
                            <h3 class="text-xl font-semibold">「{{ $query }}」の検索結果</h3>
                        @endif
                    </div>

                    <!-- 検索結果 -->
                    @if($medicines->isEmpty())
                        <div class="py-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-lg">該当する薬は見つかりませんでした。</p>
                            <p class="text-gray-400 mt-2">別のキーワードで検索してみてください。</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($medicines as $medicine)
                                <div class="border rounded-lg p-5 hover:shadow-md transition-shadow">
                                    <div class="flex items-center">
                                        @if($medicine->image_path)
                                            <img src="{{ asset('storage/' . $medicine->image_path) }}" 
                                                 alt="{{ $medicine->name }}" 
                                                 class="w-20 h-20 object-cover rounded-lg mr-4">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                                <span class="text-gray-500">No Image</span>
                                            </div>
                                        @endif
                                        <h4 class="text-xl font-bold text-blue-700">{{ $medicine->name }}</h4>
                                    </div>
                                    <div class="flex flex-wrap gap-2 mt-2 mb-3">
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">{{ $medicine->category }}</span>
                                        <div class="flex items-center space-x-2">
                                            @foreach(is_array($medicine->country) ? $medicine->country : json_decode($medicine->country) as $country)
                                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                                    {{ $country }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <p class="text-gray-600 font-semibold mt-2">価格：{{ $medicine->price }} {{ $medicine->currency_code }}</p>
                                    <p class="mt-3 text-gray-700">{{ $medicine->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- ナビゲーションリンク -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('medicines.search') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            別の薬を検索
                        </a>
                        @if(request()->has('category'))
                            <a href="{{ route('medicines.category') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                                カテゴリ一覧に戻る
                            </a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 flex items-center">
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