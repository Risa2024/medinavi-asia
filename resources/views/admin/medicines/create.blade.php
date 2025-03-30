<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">📌 MediNavi Asia 管理画面</h1>

        <div class="bg-gray-100 rounded p-6">
            <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- name -->
                <div class="mb-4">
                    <label class="block mb-2">商品名：</label>
                    <input type="text" name="name" required class="w-full border p-2">
                </div>

                <!-- image_path -->
                <div class="mb-4">
                    <label class="block mb-2">画像：</label>
                    <input type="file" name="image" required class="w-full border p-2">
                </div>

                <!-- currency_code -->
                <div class="mb-4">
                    <label class="block mb-2">通貨コード：</label>
                    <select name="currency_code" required class="w-full border p-2">
                        <option value="">選択してください</option>
                        <option value="IDR">IDR（インドネシアルピア）</option>
                        <option value="MYR">MYR（マレーシアリンギット）</option>
                        <option value="THB">THB（タイバーツ）</option>
                    </select>
                </div>

                <!-- price -->
                <div class="mb-4">
                    <label class="block mb-2">価格：</label>
                    <input type="number" name="price" required class="w-full border p-2">
                </div>

                <!-- description -->
                <div class="mb-4">
                    <label class="block mb-2">説明：</label>
                    <textarea name="description" class="w-full border p-2" rows="4"></textarea>
                </div>

                <!-- category -->
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

                <!-- country -->
                <div class="mb-4">
                    <label class="block mb-2">国：</label>
                    <select name="country" required class="w-full border p-2">
                        <option value="">選択してください</option>
                        <option value="インドネシア">インドネシア</option>
                        <option value="マレーシア">マレーシア</option>
                        <option value="タイ">タイ</option>
                    </select>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">
                        登録
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 