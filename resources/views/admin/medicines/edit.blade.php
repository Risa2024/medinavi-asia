<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold py-6">📝 MediNavi Asia 薬情報編集</h1>

        <div class="mb-4">
            <a href="{{ route('admin.index') }}" class="text-blue-500 hover:underline">
                &larr; 管理画面に戻る<!--&larr; ← 左矢印（←）&rarr; → 右矢印（→）&uarr; → 上矢印（↑）&darr; → 下矢印（↓）-->
            </a>
        </div>

        <div class="bg-gray-100 rounded p-6">
            <!-- フォームの開始：商品編集用のフォーム -->
            <!-- route('admin.medicines.update')：AdminControllerのupdateメソッドを呼び出すルート -->
            <!-- method="POST" と @method('PUT')：HTMLフォームはGETとPOSTしかサポートしていないため -->
            <!-- enctype="multipart/form-data"：ファイルアップロードに必要な属性 -->
            <form action="{{ route('admin.medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
                @csrf  <!-- CSRF対策のためのトークン -->
                @method('PUT')  <!-- PUTメソッドを使用するためのディレクティブ -->

                <!-- 商品名入力欄 -->
                <div class="mb-4">
                    <label class="block mb-2">商品名：</label>
                    <input type="text" name="name" value="{{ $medicine->name }}" required class="w-full border p-2">
                </div>

                <!-- 画像アップロード欄 -->
                <div class="mb-4">
                    <label class="block mb-2">画像：</label>
                    @if($medicine->image_path)
                        <div class="mb-3">
                            <p class="text-sm mb-2">現在の画像:</p>
                            <img src="{{ asset('storage/' . $medicine->image_path) }}" alt="{{ $medicine->name }}" class="w-32 h-32 object-contain border p-1">
                        </div>
                    @endif
                    <input type="file" name="image" class="w-full border p-2">
                    <p class="text-sm text-gray-500 mt-1">※新しい画像をアップロードしない場合は現在の画像が保持されます</p>
                </div>

                <!-- 商品説明入力欄 -->
                <div class="mb-4">
                    <label class="block mb-2">説明：</label>
                    <textarea name="description" class="w-full border p-2" rows="4">{{ $medicine->description }}</textarea>
                </div>

                <!-- カテゴリー選択欄 -->
                <div class="mb-4">
                    <label class="block mb-2">カテゴリー：</label>
                    <select name="category" required class="w-full border p-2">
                        <option value="">選択してください</option>
                        <option value="腹痛薬" {{ $medicine->category == '腹痛薬' ? 'selected' : '' }}>腹痛薬</option>
                        <option value="解熱鎮痛薬" {{ $medicine->category == '解熱鎮痛薬' ? 'selected' : '' }}>解熱鎮痛薬</option>
                        <option value="胃腸薬" {{ $medicine->category == '胃腸薬' ? 'selected' : '' }}>胃腸薬</option>
                        <option value="風邪薬" {{ $medicine->category == '風邪薬' ? 'selected' : '' }}>風邪薬</option>
                        <option value="目薬" {{ $medicine->category == '目薬' ? 'selected' : '' }}>目薬</option>
                        <option value="皮膚薬" {{ $medicine->category == '皮膚薬' ? 'selected' : '' }}>皮膚薬</option>
                        <option value="下痢止め" {{ $medicine->category == '下痢止め' ? 'selected' : '' }}>下痢止め</option>
                    </select>
                </div>

                <!-- 国と価格情報：複数の国に対応するセクション -->
                <div class="mb-4">
                    <label class="block mb-2 font-medium">販売国と価格情報：</label>
                    <div class="bg-white p-4 rounded border">
                        @php
                            // 現在選択されている国の配列を作成
                            $selectedCountries = $medicine->countries->pluck('name')->toArray();

                            // 各国のデータを取得
                            $indonesiaCountry = $medicine->countries->where('name', 'インドネシア')->first();
                            $malaysiaCountry = $medicine->countries->where('name', 'マレーシア')->first();
                            $thailandCountry = $medicine->countries->where('name', 'タイ')->first();
                            $vietnamCountry = $medicine->countries->where('name', 'ベトナム')->first();
                        @endphp

                        <!-- インドネシア情報入力セクション -->
                        <div class="mb-4 pb-3 border-b">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="インドネシア" id="country-id" class="mr-2" {{ in_array('インドネシア', $selectedCountries) ? 'checked' : '' }}>
                                <label for="country-id" class="font-medium">🇮🇩 インドネシア</label>
                            </div>
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (IDR)：</label>
                                    <input type="number" name="price_id" value="{{ $indonesiaCountry->pivot->price ?? '' }}" class="w-full border p-2">
                                </div>
                            </div>
                        </div>

                        <!-- マレーシア情報入力セクション -->
                        <div class="mb-4 pb-3 border-b">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="マレーシア" id="country-my" class="mr-2" {{ in_array('マレーシア', $selectedCountries) ? 'checked' : '' }}>
                                <label for="country-my" class="font-medium">🇲🇾 マレーシア</label>
                            </div>
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (MYR)：</label>
                                    <input type="number" name="price_my" value="{{ $malaysiaCountry->pivot->price ?? '' }}" class="w-full border p-2">
                                </div>
                            </div>
                        </div>

                        <!-- タイ情報入力セクション -->
                        <div class="mb-4 pb-3 border-b">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="タイ" id="country-th" class="mr-2" {{ in_array('タイ', $selectedCountries) ? 'checked' : '' }}>
                                <label for="country-th" class="font-medium">🇹🇭 タイ</label>
                            </div>
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (THB)：</label>
                                    <input type="number" name="price_th" value="{{ $thailandCountry->pivot->price ?? '' }}" class="w-full border p-2">
                                </div>
                            </div>
                        </div>

                        <!-- ベトナム情報入力セクション -->
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="ベトナム" id="country-vn" class="mr-2" {{ in_array('ベトナム', $selectedCountries) ? 'checked' : '' }}>
                                <label for="country-vn" class="font-medium">🇻🇳 ベトナム</label>
                            </div>
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (VND)：</label>
                                    <input type="number" name="price_vn" value="{{ $vietnamCountry->pivot->price ?? '' }}" class="w-full border p-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 送信ボタンセクション -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg">
                        キャンセル
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                        <span>更新</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>