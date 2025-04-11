<x-app-layout>
    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">📝 薬情報の登録</h1>

                <a href="{{ route('admin.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    一覧に戻る
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- フォームの開始：商品登録用のフォーム -->
                <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf  <!-- CSRF対策のためのトークン -->

                    <!-- 商品名入力欄 -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">商品名：</label>
                        <input type="text" id="name" name="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- 画像アップロード欄 -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">画像：</label>
                        <div class="mt-1 flex items-center">
                            <div class="flex-shrink-0 h-24 w-24 bg-gray-100 rounded-md overflow-hidden border border-gray-200 flex items-center justify-center mr-3">
                                <svg class="h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <img id="image-preview" src="#" alt="プレビュー" class="h-full w-full object-cover hidden">
                            </div>
                            <div class="flex-1">
                                <input type="file" id="image" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" onchange="previewImage(this)">
                                <p class="text-xs text-gray-500 mt-1">JPG、PNG、JPEG形式（最大2MB）</p>
                                <p class="text-xs text-gray-500">※画像のアップロードは任意です</p><!--画像フィールドのrequired属性を削除し、任意であることを示す説明文を追加
                                コントローラー（AdminController.php）のバリデーションルールを変更し、画像フィールドを'required'から'nullable'に変更-->
                            </div>
                        </div>
                    </div>

                    <!-- 商品説明入力欄 -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">説明：</label>
                        <textarea id="description" name="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>

                    <!-- カテゴリー選択欄 -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">カテゴリー：</label>
                        <select id="category" name="category" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">選択してください</option>
                            <option value="腹痛薬">腹痛薬</option>
                            <option value="解熱鎮痛薬">解熱鎮痛薬</option>
                            <option value="胃腸薬">胃腸薬</option>
                            <option value="風邪薬">風邪薬</option>
                            <option value="目薬">目薬</option>
                            <option value="皮膚薬">皮膚薬</option>
                            <option value="下痢止め">下痢止め</option>
                        </select>
                    </div>

                    <!-- 国と価格情報：複数の国に対応するセクション -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">販売国と価格：</label>
                        <div class="space-y-4">
                            @foreach($countries as $country)
                                <div class="p-3 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox"
                                               id="country_{{ $country->id }}"
                                               name="countries[]"
                                               value="{{ $country->id }}"
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="country_{{ $country->id }}" class="ml-2 block text-sm font-medium text-gray-700">
                                            {{ $country->emoji }} {{ $country->name }}
                                        </label>
                                    </div>
                                    <div class="ml-6 mt-2">
                                        <label for="prices_{{ $country->id }}" class="block text-sm text-gray-500 mb-1">
                                            価格 ({{ $country->currency_code }})：
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm w-48">
                                            <input type="number"
                                                   id="prices_{{ $country->id }}"
                                                   name="prices[{{ $country->id }}]"
                                                   step="0.01"
                                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">{{ $country->currency_code }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 送信ボタンセクション -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            登録する
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
            const fileInput = input.files[0];

            if (fileInput) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    preview.parentElement.querySelector('svg').classList.add('hidden');
                }

                reader.readAsDataURL(fileInput);
            }
        }
    </script>
</x-app-layout>