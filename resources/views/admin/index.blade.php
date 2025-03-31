<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">📌 MediNavi Asia 管理画面</h1>

        <div class="bg-gray-100 rounded p-6">
            <!-- 新規登録ボタン -->
            <div class="mb-6">
                <a href="{{ route('admin.medicines.create') }}">
                    <h2 class="text-xl font-bold mb-4">➕ 新規登録</h2>
                </a>
            </div>

            <!-- 登録薬のリスト -->
            <div class="bg-white rounded shadow">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">商品名</th>
                            <th class="px-4 py-2 text-left">画像</th>
                            <th class="px-4 py-2 text-left">カテゴリー</th>
                            <th class="px-4 py-2 text-left">販売国</th>
                            <th class="px-4 py-2 text-left">価格</th>
                            <th class="px-4 py-2 text-left">削除</th>
                        </tr>
                    </thead>
             <!-- テーブルの本体部分 -->
                    <tbody>
                        @foreach($medicines as $medicine)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $medicine->name }}</td>
                            <td class="px-4 py-2">
                                @if($medicine->image_path)
                                    <img src="{{ asset('storage/' . $medicine->image_path) }}"
                                         alt="{{ $medicine->name }}"
                                         class="w-16 h-16 object-cover rounded">
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $medicine->category }}</td>
                            <td class="px-4 py-2">
                                @foreach($medicine->country as $country)
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm mr-1">
                                        {{ $country }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-4 py-2">
                                {{ number_format($medicine->price) }} {{ $medicine->currency_code }}
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.medicines.destroy', $medicine) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500"
                                            onclick="return confirm('削除してもよろしいですか？')">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($medicines->isEmpty())
                <div class="text-center py-8 text-gray-500">
                    登録されている薬はありません
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>