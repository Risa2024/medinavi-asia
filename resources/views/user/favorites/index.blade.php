<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __("お気に入り一覧") }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          @php
            $currencyNames = [
                "IDR" => "ルピア",
                "THB" => "バーツ",
                "MYR" => "リンギット",
                "VND" => "ドン",
                "JPY" => "円",
                "PHP" => "ペソ",
                "SGD" => "ドル",
                "KHR" => "リエル",
                "MMK" => "チャット",
                "LAK" => "キップ",
                "BND" => "ドル",
            ];
          @endphp

          @if ($favorites->isEmpty())
            <div class="py-8 text-center">
              <svg class="mx-auto mb-4 h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p class="text-base text-gray-500">お気に入りに追加された薬はありません。</p>
              <p class="mt-2 text-sm text-gray-400">薬を検索して、お気に入りに追加してみましょう。</p>
              <div class="mt-6">
                <a class="inline-block rounded-lg bg-indigo-500 px-6 py-2 font-medium text-white hover:bg-indigo-600"
                  href="{{ route("medicines.search") }}">
                  薬を検索する
                </a>
              </div>
            </div>
          @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
              @foreach ($favorites as $medicine)
                <div
                  class="group flex h-full flex-col overflow-hidden rounded-2xl border border-blue-100 bg-blue-50/10 shadow-sm transition-all duration-300 hover:bg-blue-50/20 hover:shadow-lg">
                  <!-- ヘッダー部分（薬名とカテゴリ） -->
                  <div class="border-b border-blue-100 bg-gradient-to-br from-blue-50/10 to-blue-50/30 p-4">
                    <div class="flex items-start justify-between gap-2">
                      <div class="flex-1">
                        <h2 class="line-clamp-1 text-base font-bold text-blue-950">{{ $medicine->name }}</h2>

                        <!-- 販売国フラグ -->
                        <div class="mt-2 min-h-14 md:h-14 overflow-y-auto">
                          <div class="space-y-1">
                            <div class="flex flex-wrap gap-1.5">
                              @if ($medicine->countries->count() > 0)
                                @foreach ($medicine->countries as $country)
                                  <span
                                    class="inline-flex shrink-0 items-center rounded-lg border border-blue-100 bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 shadow-sm">
                                    {{ $country->emoji }} {{ $country->name }}
                                  </span>
                                @endforeach
                              @else
                                <span
                                  class="inline-flex shrink-0 items-center rounded-lg border border-red-100 bg-red-50 px-2 py-0.5 text-xs font-medium text-red-700 shadow-sm">
                                  販売国なし
                                </span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 画像セクション -->
                  <div class="bg-gradient-to-b from-blue-50/20 p-3">
                    @if ($medicine->image_path)
                      <div
                        class="flex aspect-[16/9] items-center justify-center overflow-hidden rounded-xl border border-blue-100/50 bg-white p-2 shadow-sm transition-colors group-hover:border-blue-200">
                        <img
                          class="h-full w-full transform object-contain transition-transform duration-300 group-hover:scale-105"
                          src="{{ asset("storage/" . $medicine->image_path) }}" alt="{{ $medicine->name }}" />
                      </div>
                    @else
                      <div
                        class="flex aspect-[16/9] items-center justify-center rounded-xl border border-blue-100/50 bg-blue-50/50 transition-colors group-hover:border-blue-200">
                        <span class="text-blue-300">画像なし</span>
                      </div>
                    @endif
                  </div>

                  <!-- 情報セクション -->
                  <div class="flex-1 space-y-3 p-4">
                    <!-- 商品説明 -->
                    @if ($medicine->description)
                      <div class="space-y-2">
                        <h3 class="flex items-center text-xs font-medium text-blue-900">
                          <svg class="mr-1.5 h-3.5 w-3.5 text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                          </svg>
                          効能・特徴
                        </h3>
                        <div
                          class="rounded-xl border border-blue-100/50 bg-gradient-to-br from-white to-blue-50/30 p-3 shadow-sm">
                          <div
                            class="prose prose-sm prose-blue h-[6rem] max-w-none overflow-y-auto text-xs leading-relaxed text-blue-950">
                            {!! nl2br(e($medicine->description)) !!}
                          </div>
                        </div>
                      </div>
                    @endif

                    <!-- 価格情報 -->
                    @if ($medicine->countries->count() > 0)
                      <div class="space-y-2" x-data="{ open: false }">
                        <button
                          class="group flex w-full items-center justify-between rounded-xl border border-blue-100/50 bg-gradient-to-br from-white to-blue-50/30 p-2.5 shadow-sm transition-colors hover:bg-blue-50/50"
                          @click="open = !open">
                          <span class="flex items-center text-xs font-medium text-blue-900">
                            <svg class="mr-1.5 h-3.5 w-3.5 text-blue-400" fill="none" stroke="currentColor"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                              </path>
                            </svg>
                            価格情報を確認
                          </span>
                          <svg
                            class="h-4 w-4 transform text-blue-400 transition-transform duration-200 group-hover:text-blue-500"
                            :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                          </svg>
                        </button>

                        <div class="space-y-1.5" x-show="open" x-transition:enter="transition ease-out duration-200"
                          x-transition:enter-start="opacity-0 transform -translate-y-2"
                          x-transition:enter-end="opacity-100 transform translate-y-0">
                          @foreach ($medicine->countries as $country)
                            @if ($country->pivot->price > 0)
                            <div class="flex items-center justify-between rounded-xl p-2 shadow-sm transition-colors my-1.5
                              @if(isset($countryId) && $country->id == $countryId)
                                bg-red-50 border-2 border-red-400
                              @else
                                bg-gradient-to-br from-white to-blue-50/30 border border-blue-100/50
                              @endif">
                              <span class="text-xs text-blue-900">
                                {{ $country->emoji }} {{ $country->name }}
                              </span>
                              <span class="text-xs">
                                @if ($country->pivot->price === null)
                                  <span class="text-blue-400">価格不明</span>
                                @elseif(isset($exchanges[$country->pivot->currency_code]) && isset($exchanges[$country->pivot->currency_code]->rate_to_jpy))
                                  <span
                                    class="font-medium text-blue-700">¥{{ number_format($country->pivot->price * $exchanges[$country->pivot->currency_code]->rate_to_jpy) }}</span>
                                  <span class="text-[10px] text-blue-400">({{ number_format($country->pivot->price) }}
                                    {{ $country->pivot->currency_code }})</span>
                                @else
                                  {{ number_format($country->pivot->price) }}
                                  {{ $country->pivot->currency_code }}
                                @endif
                              </span>
                            </div>
                            @endif
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </div>

                  <!-- フッター部分（お気に入りボタン） -->
                  <div class="border-t border-blue-100 bg-gradient-to-br from-blue-50/10 to-blue-50/30 p-3">
                    <div class="flex justify-end">
                      @if (Auth::check())
                        @if ($medicine->favorites->contains('user_id', Auth::id()))
                          <form action="{{ route('user.favorites.destroy', $medicine) }}" method="POST" class="favorite-form">
                            @csrf
                            @method('DELETE')
                            <button class="text-pink-500 transition-colors hover:text-pink-600" type="submit">
                              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                              </svg>
                            </button>
                          </form>
                        @else
                          <form action="{{ route('user.favorites.store', $medicine) }}" method="POST" class="favorite-form">
                            @csrf
                            <button class="text-blue-300 transition-colors hover:text-pink-500" type="submit">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
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

            <!-- ページネーション -->
            <div class="mt-6">
              {{ $favorites->links() }}
            </div>
          @endif

          <!-- ナビゲーションリンク -->
          <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
            <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md w-full sm:w-auto justify-center"
              href="{{ route('medicines.search', ['country_code' => $countryId ?? null]) }}">
              <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              別の薬を検索
            </a>
            <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md w-full sm:w-auto justify-center"
              href="{{ route('dashboard') }}">
              <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              トップに戻る
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<script>
// お気に入りフォームの非同期処理
document.addEventListener('DOMContentLoaded', function() {
  // すべてのお気に入りフォームを取得
  document.querySelectorAll('.favorite-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // 通常のフォーム送信を防止

      const url = this.getAttribute('action');
      const token = this.querySelector('input[name="_token"]').value;
      const card = this.closest('.group'); // カード要素を取得

      // Fetch APIを使用してAJAXリクエスト送信
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token,
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          _method: 'DELETE' // DELETE メソッドを指定
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // 成功したら、カードをフェードアウトして削除
          card.style.opacity = '0';
          card.style.transform = 'scale(0.95)';
          card.style.transition = 'all 0.3s ease';

          setTimeout(() => {
            card.remove();

            // カードがすべて削除されたら、空の表示を出す
            if (document.querySelectorAll('.group').length === 0) {
              location.reload(); // 空の状態を表示するためにリロード
            }
          }, 300);
        }
      })
      .catch(error => console.error('Error:', error));
    });
  });
});
</script>
