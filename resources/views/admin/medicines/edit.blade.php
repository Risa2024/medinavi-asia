<x-app-layout>
  <div class="min-h-screen bg-gray-50 py-6">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
      <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">✏️ 薬情報の編集</h1>

        <a class="flex items-center text-indigo-600 hover:text-indigo-900" href="{{ route("admin.index") }}">
          <svg class="mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
          </svg>
          一覧に戻る
        </a>
      </div>

      <div class="overflow-hidden rounded-lg bg-white shadow-md">
        <!-- フォームの開始：商品編集用のフォーム -->
        <form class="p-6" action="{{ route("admin.medicines.update", $medicine->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf <!-- CSRF対策のためのトークン -->
          @method("PUT") <!-- PUTメソッドを使用するためのディレクティブ -->

          <!-- 商品名入力欄 -->
          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700" for="name">商品名：</label>
            <input
              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              id="name" name="name" type="text" value="{{ $medicine->name }}" required>
          </div>

          <!-- 画像アップロード欄 -->
          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700" for="image">画像：</label>
            <div class="mt-1 flex items-center">
              <div class="mr-4 h-32 w-32 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 bg-gray-100">
                <img class="h-full w-full object-contain" id="current-image"
                  src="{{ asset("storage/" . $medicine->image_path) }}" alt="{{ $medicine->name }}">
                <img class="hidden h-full w-full object-contain" id="image-preview" src="#" alt="プレビュー">
              </div>
              <div class="flex-1">
                <input
                  class="w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                  id="image" name="image" type="file" onchange="previewImage(this)">
                <p class="mt-1 text-xs text-gray-500">JPG、PNG、JPEG形式（最大2MB）</p>
                <p class="text-xs text-gray-500">※新しい画像を選択しない場合は現在の画像が維持されます</p>
              </div>
            </div>
          </div>

          <!-- 商品説明入力欄 -->
          <div class="mb-6">
            <label class="mb-2 block text-sm font-medium text-gray-700" for="description">説明：</label>
            <textarea
              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              id="description" name="description" rows="4">{{ $medicine->description }}</textarea>
          </div>

          <!-- カテゴリー選択欄 -->
          <div class="mb-6">
            <div class="mb-2 flex items-center justify-between">
              <label class="block text-sm font-medium text-gray-700" for="category">カテゴリー：</label>
              <button
                class="add-category-btn inline-flex items-center rounded-full bg-emerald-500 px-3 py-1.5 text-xs font-medium text-white transition-colors duration-200 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                type="button">
                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                新しいカテゴリーを追加
              </button>
            </div>
            <select
              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              id="category" name="category" required>
              <option value="">選択してください</option>
              @foreach ($categories as $category)
                <option value="{{ $category }}" {{ $medicine->category == $category ? "selected" : "" }}>
                  {{ $category }}</option>
              @endforeach
            </select>
          </div>

          <!-- 国と価格情報：複数の国に対応するセクション -->
          <div class="mb-6">
            <div class="mb-2 flex items-center justify-between">
              <label class="block text-sm font-medium text-gray-700">販売国と価格：</label>
              <button
                class="add-country-btn inline-flex items-center rounded-full bg-emerald-500 px-3 py-1.5 text-xs font-medium text-white transition-colors duration-200 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                type="button">
                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                新しい国を追加
              </button>
            </div>
            <p class="mb-2 text-xs text-gray-500">※価格が不明な場合は入力不要</p>
            <div class="space-y-4 rounded-md border border-gray-200 bg-gray-50 p-4">
              <div>
                @foreach ($countries as $country)
                  <div class="{{ !$loop->last ? "border-b border-gray-200" : "" }} p-3">
                    <div class="mb-2 flex items-center">
                      <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        id="country_{{ $country->id }}" name="countries[]" type="checkbox"
                        value="{{ $country->id }}"
                        {{ $medicine->countries->contains("id", $country->id) ? "checked" : "" }}>
                      <label class="ml-2 block text-sm font-medium text-gray-700" for="country_{{ $country->id }}">
                        {{ $country->emoji }} {{ $country->name }}
                      </label>
                    </div>
                    <div class="ml-6 mt-2 flex items-center justify-between">
                      <div>
                        <label class="mb-1 block text-sm text-gray-500" for="prices_{{ $country->id }}">
                          価格 ({{ $country->currency_code }})：
                        </label>
                        <div class="relative mt-1 w-48 rounded-md shadow-sm">
                          <input
                            class="block w-full rounded-md border-gray-300 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            id="prices_{{ $country->id }}" name="prices[{{ $country->id }}]" type="number"
                            value="{{ $medicine->countries->where("id", $country->id)->first()?->pivot->price }}"
                            step="0.01">
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 sm:text-sm">{{ $country->currency_code }}</span>
                          </div>
                        </div>
                      </div>
                      <button
                        class="flex items-center rounded-md border border-red-200 px-2 mt-6 ml-2 py-1 text-red-500 transition-colors hover:bg-red-50 hover:text-red-700 focus:outline-none"
                        type="button" title="この国を削除"
                        onclick="confirmDeleteCountry('{{ $country->id }}', '{{ $country->name }}')">
                        <svg class="mr-0 sm:mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                          </path>
                        </svg>
                        <span class="hidden sm:inline text-xs">削除する</span>
                      </button>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 送信ボタンセクション -->
          <div class="mt-8 flex justify-between">
            <a class="rounded-md bg-gray-200 px-6 py-2 font-medium text-gray-800 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2"
              href="{{ route("admin.index") }}">
              キャンセル
            </a>
            <button
              class="flex items-center rounded-md bg-indigo-600 px-6 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              type="submit">
              <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              更新する
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // 画像プレビュー機能
    function previewImage(input) {
      const preview = document.getElementById('image-preview');
      const currentImage = document.getElementById('current-image');
      const fileInput = input.files[0];

      if (fileInput) {
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('hidden');
          if (currentImage) {
            currentImage.classList.add('hidden');
          }
        }

        reader.readAsDataURL(fileInput);
      }
    }

    // DOMContentLoadedイベントでページが完全に読み込まれた後に実行
    document.addEventListener('DOMContentLoaded', function() {
      // モーダル関連の関数
      function openCountryModal() {
        document.getElementById('countryModal').classList.remove('hidden');
      }

      function closeCountryModal() {
        document.getElementById('countryModal').classList.add('hidden');
        document.getElementById('countryForm').reset();
      }

      function openCategoryModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
      }

      function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
        document.getElementById('categoryForm').reset();
      }

      // グローバルスコープに関数を登録
      window.openCountryModal = openCountryModal;
      window.closeCountryModal = closeCountryModal;
      window.openCategoryModal = openCategoryModal;
      window.closeCategoryModal = closeCategoryModal;

      // 国追加ボタンのイベントリスナー
      document.querySelector('.add-country-btn').addEventListener('click', function() {
        console.log('国追加ボタンがクリックされました');
        openCountryModal();
      });

      // カテゴリー追加ボタンのイベントリスナー
      document.querySelector('.add-category-btn').addEventListener('click', function() {
        console.log('カテゴリー追加ボタンがクリックされました');
        openCategoryModal();
      });

      // 国の削除確認
      function confirmDeleteCountry(id, name) {
        if (confirm(`「${name}」を削除してもよろしいですか？`)) {
          deleteCountry(id);
        }
      }
      window.confirmDeleteCountry = confirmDeleteCountry;

      // 国の削除実行
      function deleteCountry(id) {
        fetch(`/admin/countries/${id}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // 成功したらページをリロード
              alert(data.message);
              window.location.reload();
            } else {
              alert(data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('国の削除に失敗しました。');
          });
      }
      window.deleteCountry = deleteCountry;

      // フォームのイベントリスナー登録
      const countryForm = document.getElementById('countryForm');
      if (countryForm) {
        console.log('国追加フォームが見つかりました');
        countryForm.addEventListener('submit', function(e) {
          e.preventDefault();
          console.log('国追加フォームが送信されました');

          const formData = new FormData(this);
          console.log('フォームデータ:', formData);

          // フォームデータの内容をログに出力
          for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
          }

          fetch('{{ route("admin.countries.store") }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            })
            .then(response => {
              console.log('レスポンスステータス:', response.status);
              return response.json();
            })
            .then(data => {
              console.log('レスポンスデータ:', data);
              if (data.success) {
                // ページをリロードして新しい国を表示
                alert(data.message || '国が正常に追加されました');
                window.location.reload();
              } else {
                alert(data.message || '国の追加に失敗しました');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('国の追加に失敗しました。詳細はコンソールを確認してください。');
            });
        });
      } else {
        console.error('国追加フォームが見つかりません');
      }

      // カテゴリー追加フォームの送信処理
      const categoryForm = document.getElementById('categoryForm');
      if (categoryForm) {
        categoryForm.addEventListener('submit', function(e) {
          e.preventDefault();

          const formData = new FormData(this);

          fetch('{{ route("admin.categories.store") }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // 新しいカテゴリーをセレクトボックスに追加
                const select = document.getElementById('category');
                const option = document.createElement('option');
                option.value = data.category_name;
                option.textContent = data.category_name;
                select.appendChild(option);

                // 新しく追加したカテゴリーを選択状態にする
                select.value = data.category_name;

                // モーダルを閉じる
                closeCategoryModal();

                // フォームをリセット
                this.reset();

                alert(data.message || 'カテゴリーが正常に追加されました');
              } else {
                alert(data.message || 'カテゴリーの追加に失敗しました');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('カテゴリーの追加に失敗しました。');
            });
        });
      }
    });
  </script>

  <!-- 新しい国を追加するモーダル -->
  <div class="fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-gray-600 bg-opacity-50" id="countryModal">
    <div class="relative top-20 mx-auto w-96 rounded-md border bg-white p-5 shadow-lg">
      <div class="mt-3">
        <h3 class="mb-2 text-lg font-medium text-gray-900">新しい国を追加</h3>
        <p class="mb-4 text-xs text-red-500">※全項目入力必須</p>
        <form class="space-y-4" id="countryForm">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700" for="name">国名</label>
            <input
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              id="name" name="name" type="text" placeholder="例：フィリピン" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700" for="emoji">絵文字</label>
            <input
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              id="emoji" name="emoji" type="text" placeholder="例：🇵🇭" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700" for="currency_code">通貨コード</label>
            <input
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              id="currency_code" name="currency_code" type="text" placeholder="例：PHP" required>
          </div>
          <div class="flex justify-end space-x-3">
            <button
              class="rounded-md bg-gray-200 px-4 py-2 font-medium text-gray-800 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2"
              type="button" onclick="closeCountryModal()">
              キャンセル
            </button>
            <button
              class="rounded-md bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              type="submit">
              追加
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 新しいカテゴリーを追加するモーダル -->
  <div class="fixed inset-0 z-50 hidden h-full w-full overflow-y-auto bg-gray-600 bg-opacity-50" id="categoryModal">
    <div class="relative top-20 mx-auto w-96 rounded-md border bg-white p-5 shadow-lg">
      <div class="mt-3">
        <h3 class="mb-4 text-lg font-medium text-gray-900">新しいカテゴリーを追加</h3>
        <form class="space-y-4" id="categoryForm">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700" for="category_name">カテゴリー名</label>
            <input
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              id="category_name" name="category_name" type="text" placeholder="例：風邪薬" required>
          </div>
          <div class="flex justify-end space-x-3">
            <button
              class="rounded-md bg-gray-200 px-4 py-2 font-medium text-gray-800 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2"
              type="button" onclick="closeCategoryModal()">
              キャンセル
            </button>
            <button
              class="rounded-md bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              type="submit">
              追加
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
