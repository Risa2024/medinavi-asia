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
                                <div class="bg-white shadow-sm hover:shadow-md transition-all duration-300 rounded-xl border border-gray-100 overflow-hidden flex flex-col h-full">
                                    <!-- ヘッダー部分（薬名とカテゴリ） -->
                                    <div class="p-4 border-b border-gray-50">
                                        <div class="flex justify-between items-start gap-2">
                                            <div class="flex-1">
                                                <h2 class="text-base font-bold text-gray-900 line-clamp-1">💊 {{ $medicine->name }}</h2>
                                                <!-- 販売国フラグ -->
                                                @if($medicine->countries->count() > 0)
                                                    <div class="mt-2">
                                                        <div x-data="{ showAll: false }">
                                                            <div class="flex flex-wrap gap-1">
                                                                @foreach($medicine->countries->take(2) as $country)
                                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                                        {{ $country->emoji }} {{ $country->name }}
                                                                    </span>
                                                                @endforeach
                                                                @if($medicine->countries->count() > 2)
                                                                    <button @click="showAll = !showAll"
                                                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100">
                                                                        <span x-show="!showAll">+{{ $medicine->countries->count() - 2 }}ヶ国</span>
                                                                        <span x-show="showAll">-</span>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <div x-show="showAll"
                                                                 x-transition:enter="transition ease-out duration-200"
                                                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                                                 class="mt-1 flex flex-wrap gap-1">
                                                                @foreach($medicine->countries->skip(2) as $country)
                                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                                        {{ $country->emoji }} {{ $country->name }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="shrink-0 bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-xs font-medium">
                                                {{ $medicine->category }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- 画像セクション -->
                                    <div class="p-3 bg-gradient-to-b from-gray-50/50">
                                        @if($medicine->image_path)
                                            <div class="aspect-[3/2] rounded-lg overflow-hidden bg-white flex items-center justify-center p-2 border border-gray-100">
                                                <img src="{{ asset('storage/' . $medicine->image_path) }}"
                                                     alt="{{ $medicine->name }}"
                                                     class="w-full h-full object-contain" />
                                            </div>
                                        @else
                                            <div class="aspect-[3/2] rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100">
                                                <span class="text-gray-400">画像なし</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- 情報セクション -->
                                    <div class="flex-1 p-4 space-y-3">
                                        <!-- 商品説明 -->
                                        @if($medicine->description)
                                            <div class="space-y-2">
                                                <h3 class="font-medium text-xs text-gray-700 flex items-center">
                                                    <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    効能・特徴
                                                </h3>
                                                <div class="bg-gray-50 rounded p-2">
                                                    <div class="text-xs text-gray-600 leading-relaxed h-[4.5rem] overflow-y-auto">
                                                        {!! nl2br(e($medicine->description)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- 価格情報 -->
                                        @if($medicine->countries->count() > 0)
                                            <div x-data="{ open: false }" class="space-y-2">
                                                <button @click="open = !open"
                                                        class="w-full flex items-center justify-between p-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors group">
                                                    <span class="font-medium text-xs text-gray-700 flex items-center">
                                                        <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        価格情報を確認
                                                    </span>
                                                    <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200 group-hover:text-gray-600" 
                                                         :class="{'rotate-180': open}"
                                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                                
                                                <div x-show="open"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                                     class="space-y-1.5">
                                                    @foreach($medicine->countries as $country)
                                                        <div class="flex items-center justify-between p-1.5 bg-gray-50 rounded hover:bg-gray-100 transition-colors">
                                                            <span class="text-xs text-gray-600">
                                                                {{ $country->emoji }} {{ $country->name }}
                                                            </span>
                                                            <span class="text-xs">
                                                                @if($country->pivot->price === null)
                                                                    <span class="text-gray-400">価格不明</span>
                                                                @elseif(isset($exchanges[$country->pivot->currency_code]))
                                                                    <span class="font-medium text-blue-700">¥{{ number_format($country->pivot->price * $exchanges[$country->pivot->currency_code]->rate_to_jpy) }}</span>
                                                                    <span class="text-gray-400 text-[10px]">({{ number_format($country->pivot->price) }} {{ $currencyNames[$country->pivot->currency_code] ?? $country->pivot->currency_code }})</span>
                                                                @else
                                                                    {{ number_format($country->pivot->price) }} {{ $currencyNames[$country->pivot->currency_code] ?? $country->pivot->currency_code }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- フッター部分（お気に入りボタン） -->
                                    <div class="p-3 border-t border-gray-50">
                                        <div class="flex justify-end">
                                            @if(Auth::check())
                                                @if($medicine->favorites->contains('user_id', Auth::id()))
                                                    <form action="{{ route('favorites.destroy', $medicine) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-600 transition-colors">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('favorites.store', $medicine) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
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