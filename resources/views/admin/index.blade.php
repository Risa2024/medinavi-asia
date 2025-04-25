<x-app-layout>
  <div class="min-h-screen bg-[#F2F2F2] py-6">
    <div class="mx-auto max-w-[1280px] px-4 sm:px-6 lg:px-8">
      <!-- ヘッダーセクション -->
      <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center">
          <h1 class="flex items-center text-xl font-bold sm:text-2xl">
            <div class="mr-3 flex h-10 w-10 items-center justify-center">
              <span class="text-white">🏥</span>
            </div>
            <span class="text-[#0B1E26]">
              MediNavi Asia 管理画面
            </span>
          </h1>
        </div>
        <div class="flex">
          <a class="group flex w-full transform items-center justify-center rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark px-5 py-2.5 font-medium text-white shadow-lg transition-all duration-300 hover:-translate-y-0.5 hover:from-medinavi-blue-dark hover:to-medinavi-blue sm:w-auto"
            href="{{ route("admin.medicines.create") }}">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
              </path>
            </svg>
            新しい薬を追加
          </a>
        </div>
      </div>

      <!-- 検索フォーム -->
      <div class="mb-8 rounded-xl border border-gray-100 bg-white p-4 shadow-lg sm:p-6">
        <form class="flex flex-col gap-4 sm:flex-row" action="{{ route("admin.index") }}" method="GET">
          <div class="relative flex-grow">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-medinavi-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
            <input
              class="w-full rounded-lg border border-gray-200 py-3 pl-10 pr-4 transition-all duration-200 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-600"
              name="search" type="text" value="{{ request("search") }}" placeholder="薬品名で検索...">
          </div>
          <button
            class="w-full transform rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark px-6 py-3 text-sm font-semibold text-white shadow-md transition-all duration-300 hover:-translate-y-0.5 hover:from-medinavi-blue-dark hover:to-medinavi-blue hover:shadow-lg sm:w-auto"
            type="submit">
            検索
          </button>
        </form>
      </div>

      <!-- 検索結果メッセージ -->
      @if (request("search"))
        <div class="mb-6 rounded-lg border border-teal-100 bg-teal-50 px-4 py-3 text-[#0B1E26] sm:px-6">
          <div class="flex items-center">
            <svg class="mr-2 h-5 w-5 text-medinavi-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>「<span class="font-medium text-medinavi-blue">{{ request("search") }}</span>」の検索結果: <span
                class="font-medium text-medinavi-blue">{{ $medicines->count() }}</span>件</span>
          </div>
        </div>
      @endif

      <!-- 登録薬のリスト -->
      <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-lg">
        <!-- モバイル表示用のカードビュー -->
        <div class="block sm:hidden">
          @foreach ($medicines as $medicine)
            <div class="border-b border-gray-100 p-4">
              <div class="flex items-start gap-4">
                @if ($medicine->image_path)
                  <div
                    class="flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-lg border border-gray-100 bg-[#F2F2F2] p-1 shadow-sm">
                    <img
                      class="h-full w-full cursor-pointer object-contain transition-all duration-300 hover:opacity-80"
                      src="{{ asset("storage/" . $medicine->image_path) }}" alt="{{ $medicine->name }}"
                      onclick="openImageModal('{{ asset("storage/" . $medicine->image_path) }}', '{{ $medicine->name }}')" />
                  </div>
                @else
                  <div
                    class="flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-lg border border-gray-100 bg-[#F2F2F2] p-1 shadow-sm">
                    <span class="text-xs text-gray-400">画像なし</span>
                  </div>
                @endif
                <div class="flex-grow">
                  <h3 class="mb-2 text-lg font-medium text-[#0B1E26]">{{ $medicine->name }}</h3>
                  <div class="mb-2">
                    <span
                      class="inline-flex items-center rounded-md border border-teal-100 bg-teal-50 px-2.5 py-1.5 text-xs font-medium text-teal-600">
                      {{ $medicine->category }}
                    </span>
                  </div>
                  <div class="mb-2">
                    @if ($medicine->countries->count() > 0)
                      <div class="flex flex-wrap gap-1.5">
                        @foreach ($medicine->countries as $country)
                          <span
                            class="inline-flex items-center whitespace-nowrap rounded-md border border-gray-200 bg-[#F2F2F2] px-2 py-0.5 text-xs font-medium text-[#0B1E26]">
                            {{ $country->emoji }} {{ $country->name }}
                            @if ($country->pivot->price !== null)
                              - {{ number_format($country->pivot->price) }} {{ $country->pivot->currency_code }}
                            @endif
                          </span>
                        @endforeach
                      </div>
                    @else
                      <span class="text-sm text-gray-400">販売国未設定</span>
                    @endif
                  </div>
                  <div class="flex gap-3">
                    <a class="flex items-center text-medinavi-blue transition-colors duration-200 hover:text-medinavi-blue-dark"
                      href="{{ route("admin.medicines.edit", $medicine->id) }}">
                      <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                      </svg>
                      <span>編集</span>
                    </a>
                    <form class="inline" action="{{ route("admin.medicines.destroy", $medicine->id) }}" method="POST">
                      @csrf
                      @method("DELETE")
                      <button class="flex items-center text-red-500 transition-colors duration-200 hover:text-red-600"
                        type="submit" onclick="return confirm('削除してもよろしいですか？')">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                          </path>
                        </svg>
                        <span>削除</span>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <!-- デスクトップ表示用のテーブル -->
        <div class="hidden overflow-x-auto sm:block">
          <table class="w-full divide-y divide-gray-200">
            <thead class="bg-[#F2F2F2]">
              <tr>
                <th class="w-[200px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[#0B1E26]">
                  薬品名</th>
                <th class="w-[100px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[#0B1E26]">
                  画像</th>
                <th class="w-[120px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[#0B1E26]">
                  カテゴリー</th>
                <th class="w-[180px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[#0B1E26]">
                  販売国</th>
                <th class="w-[150px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[#0B1E26]">
                  価格</th>
                <th class="w-[100px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[#0B1E26]">
                  編集</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
              @foreach ($medicines as $medicine)
                <tr class="transition-colors duration-200 hover:bg-[#F2F2F2]">
                  <td class="px-4 py-3">
                    <div class="max-w-[180px] truncate text-sm font-medium text-[#0B1E26]">{{ $medicine->name }}</div>
                  </td>
                  <td class="px-4 py-3">
                    @if ($medicine->image_path)
                      <div
                        class="flex h-16 w-16 items-center justify-center rounded-lg border border-gray-100 bg-[#F2F2F2] p-1 shadow-sm">
                        <img
                          class="h-full w-full cursor-pointer object-contain transition-all duration-300 hover:scale-105 hover:opacity-80"
                          src="{{ asset("storage/" . $medicine->image_path) }}" alt="{{ $medicine->name }}"
                          onclick="openImageModal('{{ asset("storage/" . $medicine->image_path) }}', '{{ $medicine->name }}')" />
                      </div>
                    @else
                      <div
                        class="flex h-16 w-16 items-center justify-center rounded-lg border border-gray-100 bg-[#F2F2F2] p-1 shadow-sm">
                        <span class="text-xs text-gray-400">画像なし</span>
                      </div>
                    @endif
                  </td>
                  <td class="px-4 py-3">
                    <div class="w-[130px]">
                      <span
                        class="inline-flex items-center rounded-md border border-teal-100 bg-teal-50 px-2.5 py-1.5 text-xs font-medium text-teal-600">
                        {{ $medicine->category }}
                      </span>
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    @if ($medicine->countries->count() > 0)
                      <div class="flex max-w-[160px] flex-wrap gap-1.5">
                        @foreach ($medicine->countries as $country)
                          <span
                            class="inline-flex transform items-center whitespace-nowrap rounded-md border border-gray-200 bg-[#F2F2F2] px-2 py-0.5 text-xs font-medium text-[#0B1E26] transition-transform duration-200 hover:scale-105">
                            {{ $country->emoji }} {{ $country->name }}
                          </span>
                        @endforeach
                      </div>
                    @else
                      <span class="text-sm text-gray-400">未設定</span>
                    @endif
                  </td>
                  <td class="px-4 py-3">
                    @if ($medicine->countries->count() > 0)
                      <div class="space-y-1.5">
                        @foreach ($medicine->countries as $country)
                          <div class="flex items-center space-x-1 whitespace-nowrap text-sm text-[#0B1E26]">
                            @if ($country->pivot->price === null)
                              <span class="text-gray-400">価格不明</span>
                            @else
                              <span class="font-medium">{{ number_format($country->pivot->price) }}</span>
                              <span class="text-gray-400">{{ $country->pivot->currency_code }}</span>
                            @endif
                          </div>
                        @endforeach
                      </div>
                    @else
                      <span class="text-sm text-gray-400">-</span>
                    @endif
                  </td>
                  <td class="px-4 py-3 text-sm font-medium">
                    <div class="flex flex-col space-y-2">
                      <a class="flex items-center text-medinavi-blue transition-colors duration-200 hover:text-medinavi-blue-dark"
                        href="{{ route("admin.medicines.edit", $medicine->id) }}">
                        <svg class="mr-1 h-4 w-4 transform transition-transform duration-300 group-hover:rotate-12"
                          fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z">
                          </path>
                        </svg>
                        <span>編集</span>
                      </a>
                      <form class="inline" action="{{ route("admin.medicines.destroy", $medicine->id) }}"
                        method="POST">
                        @csrf
                        @method("DELETE")
                        <button
                          class="group flex items-center text-red-500 transition-colors duration-200 hover:text-red-600"
                          type="submit" onclick="return confirm('削除してもよろしいですか？')">
                          <svg class="mr-1 h-4 w-4 transform transition-transform duration-300 group-hover:rotate-12"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                          </svg>
                          <span>削除</span>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @if ($medicines->isEmpty())
          <div class="bg-[#F2F2F2] py-16 text-center">
            <div
              class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-r from-teal-600 to-emerald-500 shadow-lg">
              <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
              </svg>
            </div>
            <p class="mb-2 text-xl font-medium text-[#0B1E26]">登録されている薬はありません</p>
            <p class="text-teal-600">「新規登録」ボタンから薬情報を追加してください</p>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- 画像モーダル -->
  <div class="fixed inset-0 z-50 flex hidden items-center justify-center overflow-auto bg-[#0B1E26]/70 p-4"
    id="imageModal">
    <div class="relative mx-auto max-w-3xl rounded-lg border border-gray-100 bg-white p-6 shadow-2xl">
      <!-- 閉じるボタン -->
      <button class="absolute right-2 top-2 text-[#519A96] transition-colors hover:text-teal-600" id="closeModal">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      <!-- モーダルコンテンツ -->
      <div class="text-center">
        <h3 class="mb-4 text-lg font-semibold text-[#0B1E26]" id="modalTitle"></h3>
        <div class="rounded-lg border border-[#A0D3D9]/20 bg-[#F2F2F2] p-1">
          <img class="mx-auto max-h-[70vh] object-contain" id="modalImage" src="" alt="">
        </div>
      </div>
    </div>
  </div>

  <script>
    // モーダル関連の関数
    function openImageModal(imageSrc, imageName) {
      const modal = document.getElementById('imageModal');
      const modalImage = document.getElementById('modalImage');
      const modalTitle = document.getElementById('modalTitle');

      // 画像とタイトルを設定
      modalImage.src = imageSrc;
      modalImage.alt = imageName;
      modalTitle.textContent = imageName;

      // モーダルを表示
      modal.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }
    // モーダルを閉じる関数
    function closeImageModal() {
      const modal = document.getElementById('imageModal');
      modal.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }
    // ページ読み込み時に実行
    document.addEventListener('DOMContentLoaded', function() {
      // 閉じるボタンにイベントリスナーを追加
      document.getElementById('closeModal').addEventListener('click', closeImageModal);
    });
  </script>
</x-app-layout>
