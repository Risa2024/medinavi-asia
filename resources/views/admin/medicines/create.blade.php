<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold py-6">📌 MediNavi Asia 投稿画面</h1>

        <div class="bg-gray-100 rounded p-6">
            <!-- フォームの開始：商品登録用のフォーム -->
            <!-- route('admin.medicines.store')：AdminControllerのstoreメソッドを呼び出すルート -->
            <!-- enctype="multipart/form-data"：ファイルアップロードに必要な属性 -->
            <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf  <!-- CSRF対策のためのトークン：クロスサイトリクエストフォージェリを防止 -->

                <!-- 商品名入力欄 -->
                <!-- required属性：入力必須項目であることを示す -->
                <div class="mb-4">
                    <label class="block mb-2">商品名：</label>
                    <input type="text" name="name" required class="w-full border p-2">
                </div>

                <!-- 画像アップロード欄 -->
                <!-- type="file"：ファイル選択フィールドとして指定 -->
                <div class="mb-4">
                    <label class="block mb-2">画像：</label>
                    <input type="file" name="image" required class="w-full border p-2">
                </div>

                <!-- 商品説明入力欄 -->
                <!-- textarea：複数行のテキスト入力フィールド -->
                <div class="mb-4">
                    <label class="block mb-2">説明：</label>
                    <textarea name="description" class="w-full border p-2" rows="4"></textarea>
                </div>

                <!-- カテゴリー選択欄 -->
                <!-- select要素：ドロップダウンリストで選択肢を表示 -->
                <div class="mb-4">
                    <label class="block mb-2">カテゴリー：</label>
                    <select name="category" required class="w-full border p-2">
                        <option value="">選択してください</option>
                        <option value="腹痛薬">腹痛薬</option>
                        <option value="解熱鎮痛薬">解熱鎮痛薬</option>
                        <option value="胃腸薬">胃腸薬</option>
                        <option value="風邪薬">風邪薬</option>
                        <option value="目薬">目薬</option>
                        <option value="皮膚薬">皮膚薬</option>
                    </select>
                </div>

                <!-- 国と価格情報：複数の国に対応するセクション -->
                <div class="mb-4">
                    <label class="block mb-2 font-medium">販売国と価格情報：</label>
                    <div class="bg-white p-4 rounded border">
                        <!-- インドネシア情報入力セクション -->
                        <div class="mb-4 pb-3 border-b">
                            <!-- チェックボックス：国の選択 -->
                            <!-- name="country[]"：配列形式でデータを送信するための記法 -->
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="インドネシア" id="country-id" class="mr-2">
                                <label for="country-id" class="font-medium">🇮🇩 インドネシア</label>
                            </div>
                            <!-- 選択された国の価格入力欄 -->
                            <!-- grid-cols-2：2列のグリッドレイアウト -->
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (IDR)：</label>
                                    <input type="number" name="price_id" class="w-full border p-2">
                                </div>
                            </div>
                        </div>

                        <!-- マレーシア情報入力セクション -->
                        <div class="mb-4 pb-3 border-b">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="マレーシア" id="country-my" class="mr-2">
                                <label for="country-my" class="font-medium">🇲🇾 マレーシア</label>
                            </div>
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (MYR)：</label>
                                    <input type="number" name="price_my" class="w-full border p-2">
                                </div>
                            </div>
                        </div>

                        <!-- タイ情報入力セクション -->
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="country[]" value="タイ" id="country-th" class="mr-2">
                                <label for="country-th" class="font-medium">🇹🇭 タイ</label>
                            </div>
                            <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-sm mb-1">価格 (THB)：</label>
                                    <input type="number" name="price_th" class="w-full border p-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 送信ボタンセクション -->
                <div class="text-center mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                        <span>登録</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>