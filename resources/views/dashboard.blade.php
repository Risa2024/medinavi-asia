<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
      <div class="flex items-center">
        <div class="flex flex-shrink-0 items-center">
          <div
            class="mr-3 flex h-12 w-12 items-center justify-center overflow-hidden rounded-full bg-white border border-slate-200">
            <img class="h-9 w-9 object-contain" src="{{ asset("images/logo/logo_dark.png") }}"
              alt="MediNavi Asia Logo">
          </div>
          <span class="text-xl font-bold text-slate-800">Medi<span class="text-medinavi-blue">Navi</span> <span
              class="text-medinavi-blue-light">Asia</span></span>
        </div>
      </div>
      <nav class="flex items-center space-x-6 overflow-x-auto pb-2 sm:pb-0">
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-medinavi-blue px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:text-medinavi-blue">
          ホーム</div>
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:border-medinavi-blue hover:text-medinavi-blue">
          お気に入り</div>
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:border-medinavi-blue hover:text-medinavi-blue">
          管理画面</div>
      </nav>
    </div>
  </x-slot>

  <div class="min-h-screen bg-slate-50">
    <main class="px-4 py-8 sm:px-6 lg:px-8">
      <!-- エラーメッセージ表示 -->
      @if(session('error_message'))
      <div class="mb-6 rounded-lg bg-red-50 p-4 text-center text-red-700">
        {{ session('error_message') }}
      </div>
      @endif

      <!-- 検索セクション -->
      <section class="mb-12">
        <div class="mb-8 text-center">
          <span
            class="mb-3 inline-block rounded-full bg-medinavi-blue/10 px-3 py-1 text-sm font-semibold text-slate-800">お薬を探す</span>
          <h2 class="mb-4 text-2xl font-bold text-slate-800 sm:text-3xl">カテゴリや商品名から探す</h2>
          <p class="mx-auto max-w-2xl text-lg text-slate-600 sm:text-xl">検索方法を選んでください</p>
        </div>

        <!-- ★ここに国選択UIを追加★ -->
        <div class="flex justify-center mb-6">
          <div class="bg-white rounded-lg shadow-sm p-3 w-full max-w-2xl">
            <h3 class="text-center text-sm font-semibold mb-2">国を選択してください</h3>
            <div class="flex mb-2">
              <button id="auto-tab" class="flex-1 py-1 rounded-l-lg border border-medinavi-blue text-medinavi-blue font-bold bg-blue-50 text-sm" onclick="switchMode('auto')">
                自動取得
              </button>
              <button id="manual-tab" class="flex-1 py-1 rounded-r-lg border border-medinavi-blue text-medinavi-blue font-bold bg-white text-sm" onclick="switchMode('manual')">
                手動選択
              </button>
            </div>
            <div id="auto-content">
              <div class="mb-1 text-center">
                <span class="font-bold text-sm">現在の国：</span>
                <span id="auto-country" class="text-medinavi-blue font-bold text-sm">（自動取得中...）</span>
              </div>
              <p class="text-xs text-slate-500 text-center">現在地が対応国（インドネシア・タイ・マレーシア・ベトナム）以外の場合、全ての国の薬が表示されます</p>
            </div>
            <div id="manual-content" class="hidden">
              <div class="flex gap-2 justify-center mb-2 flex-wrap md:flex-nowrap overflow-x-auto">
                @foreach ($countries as $country)
                  <button
                    type="button"
                    class="px-3 py-1 rounded border text-sm font-medium
                      @if(old('country') == $country->name) bg-medinavi-blue text-white @else bg-white text-medinavi-blue border-medinavi-blue @endif
                      hover:bg-medinavi-blue hover:text-white transition"
                    onclick="selectCountry('{{ $country->name }}', '{{ $country->id }}')"
                    id="country-btn-{{ $country->id }}"
                  >
                    {{ $country->emoji ?? '' }}{{ $country->name }}
                  </button>
                @endforeach
              </div>
              <div class="text-center text-sm">
                選択中の国：<span id="manual-country" class="font-bold text-medinavi-blue">未選択</span>
              </div>
            </div>
          </div>
        </div>
        <!-- ★ここまで★ -->

        <!-- 既存の検索カード（カテゴリ・商品名） -->
        <div class="mx-auto max-w-6xl">
          <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2">
            <!-- 種類から検索 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="#" id="category-link"><!--国が選択されているか確認してから遷移する。document.getElementById('category-link')でこの要素を取得して処理を行う-->
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">種類から検索</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">頭痛薬、風邪薬などカテゴリで薬を探せます。症状からぴったりの薬を見つけましょう。</p>
                <div class="mb-4 flex justify-center">
                  <img class="h-auto w-36 object-contain sm:w-48 md:w-64" src="/images/medicine1.jpg" alt="薬の種類から検索">
                </div>
                <div class="mt-4">
                  <div
                    class="flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:from-medinavi-blue-dark hover:to-medinavi-blue hover:shadow-xl">
                    カテゴリから探す
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </a>

            <!-- 商品名で検索 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="#" id="search-link">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">商品名で検索</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">
                  薬の名前がわかっている場合は、商品名で直接検索できます。正確かつ素早く薬を見つけられます。</p>
                <div class="mb-4 flex justify-center">
                  <img class="h-auto w-36 object-contain sm:w-48 md:w-64" src="/images/medicine2.jpg" alt="薬の種類から検索">
                </div>
                <div class="mt-4">
                  <div
                    class="flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:from-medinavi-blue-dark hover:to-medinavi-blue hover:shadow-xl">
                    商品名で検索
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </section>
    </main>
  </div>
  <script>
    function switchMode(mode) {
      if (mode === 'auto') {
        document.getElementById('auto-content').classList.remove('hidden');
        document.getElementById('manual-content').classList.add('hidden');
        document.getElementById('auto-tab').classList.add('bg-blue-50');
        document.getElementById('manual-tab').classList.remove('bg-blue-50');
      } else {
        document.getElementById('auto-content').classList.add('hidden');
        document.getElementById('manual-content').classList.remove('hidden');
        document.getElementById('manual-tab').classList.add('bg-blue-50');
        document.getElementById('auto-tab').classList.remove('bg-blue-50');
      }
    }
    function selectCountry(name, countryId) {
      document.getElementById('manual-country').textContent = name;
      // すべてのボタンの色をリセット
      document.querySelectorAll('[id^=country-btn-]').forEach(btn => {
        btn.classList.remove('bg-medinavi-blue', 'text-white');
        btn.classList.add('bg-white', 'text-medinavi-blue');
      });
      // 選択したボタンだけ色を変える
      const selectedBtn = Array.from(document.querySelectorAll('[id^=country-btn-]')).find(btn => btn.textContent.trim() === name);
      if (selectedBtn) {
        selectedBtn.classList.add('bg-medinavi-blue', 'text-white');
        selectedBtn.classList.remove('bg-white', 'text-medinavi-blue');
      }
      // URLに国IDを追加
      const currentUrl = new URL(window.location.href);
      currentUrl.searchParams.set('country_code', countryId);
      window.history.pushState({}, '', currentUrl);

      // リンク先URLも更新
      updateSearchLinks(countryId);

      // 選択された国を保存
      localStorage.setItem('selected_country_id', countryId);
      localStorage.setItem('selected_country_name', name);
    }

    function updateSearchLinks(countryId) {
      // カテゴリ検索リンクを更新
      const categoryLink = document.querySelector('a[href*="medicines.category"]');
      if (categoryLink) {
        const categoryUrl = new URL(categoryLink.href);
        categoryUrl.searchParams.set('country_code', countryId);
        categoryLink.href = categoryUrl.toString();
      }

      // 商品名検索リンクを更新
      const searchLink = document.querySelector('a[href*="medicines.search"]');
      if (searchLink) {
        const searchUrl = new URL(searchLink.href);
        searchUrl.searchParams.set('country_code', countryId);
        searchLink.href = searchUrl.toString();
      }
    }

    // ページ読み込み時の処理
    document.addEventListener('DOMContentLoaded', function() {
      // URLパラメータから国IDを取得
      const urlParams = new URLSearchParams(window.location.search);
      let countryId = urlParams.get('country_code');

      // URLパラメータになければLocalStorageから取得
      if (!countryId) {
        countryId = localStorage.getItem('selected_country_id');
      }

      // 国IDがある場合は選択状態を復元
      if (countryId) {
        const countryBtn = document.getElementById('country-btn-' + countryId);
        if (countryBtn) {
          const countryName = countryBtn.textContent.trim();
          selectCountry(countryName, countryId);
          // 手動選択タブを表示
          switchMode('manual');
        }
      }

      // 検索リンクの更新
      updateSearchLinks(countryId);

      // カテゴリ検索リンクのクリックイベント
      document.getElementById('category-link').addEventListener('click', function(e) {
        e.preventDefault();

        // 国が選択されているか確認
        const selectedCountryId = localStorage.getItem('selected_country_id') || urlParams.get('country_code');

        if (!selectedCountryId) {
          alert('国を選択してから検索してください');
          // スクロールして国選択部分を表示
          document.querySelector('.flex.justify-center.mb-6').scrollIntoView({ behavior: 'smooth' });
          return;
        }

        // 選択された国コードを含めてリダイレクト
        window.location.href = "{{ route('medicines.category') }}?country_code=" + selectedCountryId;
      });

      // 商品名検索リンクのクリックイベント
      document.getElementById('search-link').addEventListener('click', function(e) {
        e.preventDefault();

        // 国が選択されているか確認
        const selectedCountryId = localStorage.getItem('selected_country_id') || urlParams.get('country_code');

        if (!selectedCountryId) {
          alert('国を選択してから検索してください');
          // スクロールして国選択部分を表示
          document.querySelector('.flex.justify-center.mb-6').scrollIntoView({ behavior: 'smooth' });
          return;
        }

        // 選択された国コードを含めてリダイレクト
        window.location.href = "{{ route('medicines.search') }}?country_code=" + selectedCountryId;
      });

      // 検索カードのクリックイベントを追加（国が選択されていなければ警告表示）
      const searchCards = document.querySelectorAll('a[href*="medicines"]');
      searchCards.forEach(card => {
        card.addEventListener('click', function(e) {
          const urlParams = new URLSearchParams(window.location.search);
          const countryId = urlParams.get('country_code');

          if (!countryId) {
            e.preventDefault();
            alert('国を選択してから検索してください');
            // スクロールして国選択部分を表示
            document.querySelector('.flex.justify-center.mb-6').scrollIntoView({ behavior: 'smooth' });
          }
        });
      });
    });
  </script>
</x-app-layout>
<!--試行錯誤したこと
    データ連携&引き継ぎ
    ・ダッシュボードで選択した国のIDをURLパラメータとlocalStorageの両方に保存
    ・薬の検索・表示時にcountry_codeパラメータを使用
    バックエンドでフィルタリング
    ・MedicineControllerのinCountryメソッドで、選択された国で販売されている薬だけを抽出
    フロントエンドでの国選択の検証
    ・国が選択されていない場合は検索を実行せず、警告を表示
    複数の場所での条件チェック
    ・フロントエンド（JavaScript）とバックエンド（PHP）の両方で国選択の有無を確認
    ・localStorageとURLパラメータの両方から国情報を取得する二重の仕組み
-->
