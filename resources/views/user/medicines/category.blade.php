<x-app-layout>
  <div class="min-h-screen bg-[#F8FAFC] py-6">
    <div class="mx-auto max-w-[1280px] px-6 sm:px-8 lg:px-12">
      <div class="mb-8">
        <h1 class="flex items-center text-2xl font-bold text-[#1E293B]">
          <span>薬のカテゴリー一覧</span>
        </h1>
      </div>

      <div class="rounded-xl border border-[#E2E8F0] bg-white p-6 shadow-lg">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($sortedCategories as $category)
            @php
              // デバッグ用：生成されるURLを確認
              $categoryUrl = route('medicines.category.show', ['category' => $category, 'country_code' => $countryId]);
              \Log::info('カテゴリURL生成', ['category' => $category, 'country_id' => $countryId, 'url' => $categoryUrl]);
            @endphp
            <a class="flex items-center justify-between rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-3 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md"
              href="{{ $categoryUrl }}">
              <span class="font-medium">{{ $category }}</span>
              <svg class="h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          @endforeach
        </div>

        <div class="mt-8 flex justify-center space-x-4">
          <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md"
            href="{{ route('medicines.search', ['country_code' => $countryId]) }}">
            <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            商品名で検索
          </a>
          <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md"
            href="{{ route("dashboard") }}">
            <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
              </path>
            </svg>
            トップに戻る
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // 現在のURLをコンソールに出力
    console.log('現在のページURL:', window.location.href);

    // 国コードパラメータを取得して保存する関数
    function getAndSaveCountryId() {
      // URLパラメータから取得
      const urlParams = new URLSearchParams(window.location.search);
      let countryId = urlParams.get('country_code');

      console.log('URLパラメータから取得した国コード:', countryId);

      // URLパラメータになければローカルストレージから取得
      if (!countryId) {
        countryId = localStorage.getItem('selected_country_id');
        console.log('ローカルストレージから取得した国コード:', countryId);
      }

      // 有効な国コードがあればローカルストレージに保存
      if (countryId) {
        localStorage.setItem('selected_country_id', countryId);
      }

      return countryId;
    }

    // すべてのカテゴリリンクのURLをコンソールに出力
    document.addEventListener('DOMContentLoaded', function() {
      const countryId = getAndSaveCountryId();

      // URLに国コードパラメータがない場合、もしくは空の場合
      if (!countryId) {
        console.error('URLに国コードパラメータがありません');
        document.querySelector('body').insertAdjacentHTML('beforeend',
          '<div style="position: fixed; top: 10px; left: 0; right: 0; z-index: 9999; text-align: center;">' +
          '<div style="display: inline-block; background-color: #fee2e2; color: #b91c1c; padding: 12px 16px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">' +
          '国コードパラメータがありません。ダッシュボードから国を選択してください。' +
          '<button onclick="window.location.href=\'/dashboard\'" style="margin-left: 10px; background-color: #b91c1c; color: white; padding: 3px 8px; border-radius: 4px;">' +
          'ダッシュボードへ戻る</button>' +
          '</div></div>'
        );

        // 5秒後にダッシュボードにリダイレクト
        setTimeout(function() {
          window.location.href = '/dashboard';
        }, 5000);
      }

      // カテゴリリンクを処理
      const categoryLinks = document.querySelectorAll('a[href*="medicines/category/"]');
      categoryLinks.forEach(link => {
        console.log('カテゴリリンク:', link.href);

        // リンクURLに国コードパラメータを付与
        if (countryId) {
          const linkUrl = new URL(link.href);
          linkUrl.searchParams.set('country_code', countryId);
          link.href = linkUrl.toString();
          console.log('リンク修正後:', link.href);
        }
      });

      // 検索リンクにも国コードを追加
      const searchLink = document.querySelector('a[href*="medicines.search"]');
      if (searchLink && countryId) {
        const searchUrl = new URL(searchLink.href);
        searchUrl.searchParams.set('country_code', countryId);
        searchLink.href = searchUrl.toString();
      }
    });
  </script>
</x-app-layout>
