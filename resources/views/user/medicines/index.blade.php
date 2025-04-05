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
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($medicines as $medicine)
                                <div class="bg-white shadow-md rounded-xl p-4 hover:shadow-lg transition-shadow border border-gray-100 h-full flex flex-col">
                                    <div class="flex justify-between items-center mb-3">
                                        <h2 class="text-base font-bold text-blue-600 truncate pr-2">💊 {{ $medicine->name }}</h2>
                                        <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full text-xs font-medium shadow-sm shrink-0">{{ $medicine->category }}</span>
                                    </div>

                                    <div class="flex flex-col flex-grow">
                                        <!-- 画像 -->
                                        <div class="mb-3">
                                            @if($medicine->image_path)
                                                <div class="bg-gray-50 p-2 rounded-lg flex items-center justify-center h-32 shadow-sm">
                                                    <img src="{{ asset('storage/' . $medicine->image_path) }}" 
                                                         alt="{{ $medicine->name }}" 
                                                         class="max-w-full max-h-full object-contain">
                                                </div>
                                            @else
                                                <div class="bg-gray-50 p-2 rounded-lg flex items-center justify-center h-32 shadow-sm">
                                                    <span class="text-gray-400">画像なし</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- 価格情報 -->
                                        @if($medicine->countries->count() > 0)
                                            <div class="mb-3">
                                                <h3 class="text-xs font-medium text-gray-600 flex items-center mb-2">
                                                    <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    販売価格
                                                </h3>
                                                <div class="space-y-2">
                                                    @php
                                                        $countryEmojis = [
                                                            'インドネシア' => '🇮🇩',
                                                            'タイ' => '🇹🇭',
                                                            'マレーシア' => '🇲🇾',
                                                            'ベトナム' => '🇻🇳',
                                                            '日本' => '🇯🇵'
                                                        ];

                                                        $currencyNames = [
                                                            'IDR' => 'ルピア',
                                                            'THB' => 'バーツ',
                                                            'MYR' => 'リンギット',
                                                            'VND' => 'ドン',
                                                            'JPY' => '円'
                                                        ];
                                                    @endphp

                                                    @foreach($medicine->countries as $country)
                                                        <div class="flex items-center justify-between px-2 py-1.5 bg-white rounded-md shadow-sm border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-colors">
                                                            <div class="flex items-center gap-1">
                                                                <span class="text-base">{{ $countryEmojis[$country->name] ?? '🌏' }}</span>
                                                                <span class="text-xs text-gray-700 font-medium">{{ $country->name }}</span>
                                                            </div>
                                                            <div class="text-xs font-semibold text-gray-800">
                                                                {{ number_format($country->pivot->price) }} {{ $currencyNames[$country->pivot->currency_code] ?? $country->pivot->currency_code }}
                                                                @if(isset($exchanges[$country->pivot->currency_code]))
                                                                    <span class="text-xs text-gray-500 block text-right whitespace-nowrap">
                                                                        (約 ¥{{ number_format($country->pivot->price * $exchanges[$country->pivot->currency_code]->rate_to_jpy) }})
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <h3 class="text-xs font-medium text-gray-600 flex items-center mb-2">
                                                    <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    販売価格
                                                </h3>
                                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                                    <p class="text-gray-500 text-xs">価格情報がありません</p>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- 商品説明 -->
                                        @if($medicine->description)
                                            <div class="mt-auto">
                                                <h3 class="text-xs font-medium text-gray-600 flex items-center mb-1">
                                                    <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    商品説明
                                                </h3>
                                                <p class="text-xs text-gray-700 bg-gray-50 p-2 rounded-lg">{{ Str::limit($medicine->description, 100) }}</p>
                                            </div>
                                        @endif
                                    </div>
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