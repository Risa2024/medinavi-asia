<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">✏️ 薬情報の編集</h1>

                <a href="{{ route('admin.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    一覧に戻る
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- フォームの開始：商品編集用のフォーム -->
                <form action="{{ route('admin.medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf  <!-- CSRF対策のためのトークン -->
                    @method('PUT')  <!-- PUTメソッドを使用するためのディレクティブ -->

                    <!-- 商品名入力欄 -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">商品名：</label>
                        <input type="text" id="name" name="name" value="{{ $medicine->name }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- 画像アップロード欄 -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">画像：</label>
                        <div class="mt-1 flex items-center">
                            <div class="flex-shrink-0 h-32 w-32 rounded-md overflow-hidden bg-gray-100 border border-gray-200 mr-4">
                                @if($medicine->image_path)
                                    <img src="{{ asset('storage/' . $medicine->image_path) }}" alt="{{ $medicine->name }}" class="h-full w-full object-contain" id="current-image">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-gray-400">
                                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <img id="image-preview" src="#" alt="プレビュー" class="h-full w-full object-contain hidden">
                            </div>
                            <div class="flex-1">
                                <input type="file" id="image" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" onchange="previewImage(this)">
                                <p class="text-xs text-gray-500 mt-1">JPG、PNG、JPEG形式（最大2MB）</p>
                                <p class="text-xs text-gray-500">※新しい画像を選択しない場合は現在の画像が維持されます</p>
                            </div>
                        </div>
                    </div>

                    <!-- 商品説明入力欄 -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">説明：</label>
                        <textarea id="description" name="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $medicine->description }}</textarea>
                    </div>

                    <!-- カテゴリー選択欄 -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label for="category" class="block text-sm font-medium text-gray-700">カテゴリー：</label>
                            <button type="button" class="add-category-btn inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                新しいカテゴリーを追加
                            </button>
                        </div>
                        <select id="category" name="category" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ $medicine->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 国と価格情報：複数の国に対応するセクション -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">販売国と価格：</label>
                            <button type="button" class="add-country-btn inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                新しい国を追加
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mb-2">※価格が不明な場合は入力不要</p>
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 space-y-4">
                            <div>
                                @foreach ($countries as $country)
                                    <div class="p-3 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                        <div class="flex items-center mb-2">
                                            <input type="checkbox"
                                                   id="country_{{ $country->id }}"
                                                   name="countries[]"
                                                   value="{{ $country->id }}"
                                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                                   {{ $medicine->countries->contains('id', $country->id) ? 'checked' : '' }}>
                                            <label for="country_{{ $country->id }}" class="ml-2 block text-sm font-medium text-gray-700">
                                                {{ $country->emoji }} {{ $country->name }}
                                            </label>
                                        </div>
                                        <div class="ml-6 mt-2 flex justify-between items-center">
                                            <div>
                                                <label for="prices_{{ $country->id }}" class="block text-sm text-gray-500 mb-1">
                                                    価格 ({{ $country->currency_code }})：
                                                </label>
                                                <div class="mt-1 relative rounded-md shadow-sm w-48">
                                                    <input type="number"
                                                           id="prices_{{ $country->id }}"
                                                           name="prices[{{ $country->id }}]"
                                                           value="{{ $medicine->countries->where('id', $country->id)->first()?->pivot->price }}"
                                                           step="0.01"
                                                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">{{ $country->currency_code }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" 
                                                    onclick="confirmDeleteCountry('{{ $country->id }}', '{{ $country->name }}')"
                                                    class="flex items-center text-red-500 hover:text-red-700 focus:outline-none px-2 py-1 border border-red-200 rounded-md hover:bg-red-50 transition-colors"
                                                    title="この国を削除">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="text-xs">削除する</span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- 送信ボタンセクション -->
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('admin.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                            キャンセル
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    
                    fetch('{{ route('admin.countries.store') }}', {
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
                    
                    fetch('{{ route('admin.categories.store') }}', {
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
    <div id="countryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-2">新しい国を追加</h3>
                <p class="text-xs text-red-500 mb-4">※全項目入力必須</p>
                <form id="countryForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">国名</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="例：フィリピン" required>
                    </div>
                    <div>
                        <label for="emoji" class="block text-sm font-medium text-gray-700">絵文字</label>
                        <input type="text" name="emoji" id="emoji" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="例：🇵🇭" required>
                    </div>
                    <div>
                        <label for="currency_code" class="block text-sm font-medium text-gray-700">通貨コード</label>
                        <input type="text" name="currency_code" id="currency_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="例：PHP" required>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeCountryModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                            キャンセル
                        </button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            追加
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 新しいカテゴリーを追加するモーダル -->
    <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">新しいカテゴリーを追加</h3>
                <form id="categoryForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="category_name" class="block text-sm font-medium text-gray-700">カテゴリー名</label>
                        <input type="text" name="category_name" id="category_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="例：風邪薬" required>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeCategoryModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                            キャンセル
                        </button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            追加
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>