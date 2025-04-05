<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold py-6">📌 MediNavi Asia 管理画面</h1>

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
                                    <div class="w-[50px] h-[50px] bg-white p-1 rounded-lg flex items-center justify-center shadow-sm border">
                                        <img src="{{ asset('storage/' . $medicine->image_path) }}"
                                             alt="{{ $medicine->name }}"
                                             class="max-w-full max-h-full object-contain" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $medicine->category }}</td>
                            <td class="px-4 py-2">
                                @if($medicine->countries->count() > 0)
                                    <ul class="list-disc pl-5">
                                        @foreach($medicine->countries as $country)
                                            <li>{{ $country->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($medicine->countries->count() > 0)
                                    <ul class="list-disc pl-5">
                                        @foreach($medicine->countries as $country)
                                            <li>{{ number_format($country->pivot->price) }} {{ $country->pivot->currency_code }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    0
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.medicines.destroy', $medicine->id) }}"
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