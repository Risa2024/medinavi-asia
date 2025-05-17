<!--
# 薬の商品名検索ページ (search.blade.php)

## 主な機能
- 薬の名前（商品名）での検索フォーム提供
- 選択された国のコードを保持し検索結果に引き継ぎ
- 検索クエリを medicines.results ルートに送信

## 関連ファイル
- MedicineController@search: 検索フォーム表示
- MedicineController@showResults: 検索結果表示処理
- index.blade.php: 検索結果表示
- category.blade.php: カテゴリからの検索
- dashboard.blade.php: 国選択とトップページ

## 実装メモ
- 国選択状態はlocalStorage・URLパラメータで管理
- 検索フォーム送信時に国コードをhiddenで付与
- 検索条件の復元・UI反映あり
-->

<x-app-layout>
  <div class="min-h-screen bg-[#F8FAFC] py-6">
    <div class="mx-auto max-w-[1280px] px-6 sm:px-8 lg:px-12">
      <div class="mb-8">
        <h1 class="flex items-center text-2xl font-bold text-[#1E293B]">
          <span>薬を検索</span>
        </h1>
      </div>

      <div class="rounded-xl border border-[#E2E8F0] bg-white p-6 shadow-lg">
        <!-- 必ずPOSTメソッドを使用し、適切なエンコーディングを保証 -->
        <form method="POST" action="{{ route('medicines.results') }}" class="max-w-lg mx-auto" accept-charset="UTF-8" id="searchForm">
          @csrf
          @if(isset($countryId))
          <input type="hidden" name="country_code" value="{{ $countryId }}">
          @endif
          <div class="mb-6">
            <label for="query" class="mb-2 block text-sm font-medium text-[#475569]">薬の名前を入力</label>
            <div class="relative rounded-md shadow-sm">
              <input type="text" name="query" id="query"
                class="focus:border-[#3B82F6] focus:ring-[#3B82F6] block w-full rounded-md border-[#E2E8F0] p-3 pl-10 pr-12"
                placeholder="例：パナドール、ディアペット 等">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-[#94A3B8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
            </div>
          </div>

          <button type="submit"
            class="w-full rounded-lg bg-[#3B82F6] px-5 py-3 text-white shadow-lg hover:bg-[#2563EB]">検索</button>
        </form>

        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
          <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md w-full sm:w-auto justify-center"
            href="{{ route('medicines.search', ['country_code' => $countryId]) }}">
            <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            商品名で検索
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

  <!-- JavaScriptの処理は最小限に -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('Search form initialized');
    });
  </script>
</x-app-layout>
