<x-app-layout>
    <div class="py-6 bg-[#F2F2F2] min-h-screen">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- ヘッダーセクション -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex items-center">
                    <h1 class="text-xl sm:text-2xl font-bold flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center mr-3">
                            <span class="text-white">🏥</span>
                        </div>
                        <span class="text-[#0B1E26]">
                            MediNavi Asia 管理画面
                        </span>
                    </h1>
                </div>
                <div class="flex">
                    <a href="{{ route('admin.medicines.create') }}" class="group bg-gradient-to-r from-teal-600 to-emerald-500 text-white font-medium py-2.5 px-5 rounded-lg shadow-lg hover:from-teal-700 hover:to-emerald-600 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        新しい薬を追加
                    </a>
                </div>
            </div>

            <!-- 検索フォーム -->
            <div class="mb-8 bg-white rounded-xl shadow-lg p-4 sm:p-6 border border-gray-100">
                <form action="{{ route('admin.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="薬品名で検索..."
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition-all duration-200">
                    </div>
                    <button type="submit"
                            class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-teal-600 to-emerald-500 hover:from-teal-700 hover:to-emerald-600 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 w-full sm:w-auto">
                        検索
                    </button>
                </form>
            </div>

            <!-- 検索結果メッセージ -->
            @if(request('search'))
            <div class="mb-6 text-[#0B1E26] bg-teal-50 px-4 sm:px-6 py-3 rounded-lg border border-teal-100">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>「<span class="font-medium text-teal-600">{{ request('search') }}</span>」の検索結果: <span class="font-medium text-teal-600">{{ $medicines->count() }}</span>件</span>
                </div>
            </div>
            @endif

            <!-- 登録薬のリスト -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <!-- モバイル表示用のカードビュー -->
                <div class="block sm:hidden">
                    @foreach($medicines as $medicine)
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-start gap-4">
                            @if($medicine->image_path)
                            <div class="w-20 h-20 bg-[#F2F2F2] p-1 rounded-lg flex items-center justify-center shadow-sm border border-gray-100 flex-shrink-0">
                                <img src="{{ asset('storage/' . $medicine->image_path) }}"
                                     alt="{{ $medicine->name }}"
                                     class="w-full h-full object-contain cursor-pointer hover:opacity-80 transition-all duration-300"
                                     onclick="openImageModal('{{ asset('storage/' . $medicine->image_path) }}', '{{ $medicine->name }}')" />
                            </div>
                            @else
                            <div class="w-20 h-20 bg-[#F2F2F2] p-1 rounded-lg flex items-center justify-center shadow-sm border border-gray-100 flex-shrink-0">
                                <span class="text-gray-400 text-xs">画像なし</span>
                            </div>
                            @endif
                            <div class="flex-grow">
                                <h3 class="text-lg font-medium text-[#0B1E26] mb-2">{{ $medicine->name }}</h3>
                                <div class="mb-2">
                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium text-teal-600 bg-teal-50 border border-teal-100">
                                        {{ $medicine->category }}
                                    </span>
                                </div>
                                <div class="mb-2">
                                    @if($medicine->countries->count() > 0)
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($medicine->countries as $country)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-[#F2F2F2] text-[#0B1E26] border border-gray-200 whitespace-nowrap">
                                                    {{ $country->emoji }} {{ $country->name }}
                                                    @if($country->pivot->price !== null)
                                                        - {{ number_format($country->pivot->price) }} {{ $country->pivot->currency_code }}
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">販売国未設定</span>
                                    @endif
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.medicines.edit', $medicine->id) }}" 
                                       class="text-teal-600 hover:text-emerald-500 flex items-center transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        <span>編集</span>
                                    </a>
                                    <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-600 flex items-center transition-colors duration-200" 
                                                onclick="return confirm('削除してもよろしいですか？')">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-[#F2F2F2]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-[#0B1E26] uppercase tracking-wider w-[200px]">薬品名</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-[#0B1E26] uppercase tracking-wider w-[100px]">画像</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-[#0B1E26] uppercase tracking-wider w-[120px]">カテゴリー</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-[#0B1E26] uppercase tracking-wider w-[180px]">販売国</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-[#0B1E26] uppercase tracking-wider w-[150px]">価格</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-[#0B1E26] uppercase tracking-wider w-[100px]">編集</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($medicines as $medicine)
                            <tr class="transition-colors duration-200 hover:bg-[#F2F2F2]">
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-[#0B1E26] truncate max-w-[180px]">{{ $medicine->name }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($medicine->image_path)
                                        <div class="w-16 h-16 bg-[#F2F2F2] p-1 rounded-lg flex items-center justify-center shadow-sm border border-gray-100">
                                            <img src="{{ asset('storage/' . $medicine->image_path) }}"
                                                 alt="{{ $medicine->name }}"
                                                 class="w-full h-full object-contain cursor-pointer hover:opacity-80 hover:scale-105 transition-all duration-300"
                                                 onclick="openImageModal('{{ asset('storage/' . $medicine->image_path) }}', '{{ $medicine->name }}')" />
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-[#F2F2F2] p-1 rounded-lg flex items-center justify-center shadow-sm border border-gray-100">
                                            <span class="text-gray-400 text-xs">画像なし</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="w-[130px]">
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium text-teal-600 bg-teal-50 border border-teal-100">
                                            {{ $medicine->category }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($medicine->countries->count() > 0)
                                        <div class="flex flex-wrap gap-1.5 max-w-[160px]">
                                            @foreach($medicine->countries as $country)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-[#F2F2F2] text-[#0B1E26] border border-gray-200 whitespace-nowrap transform hover:scale-105 transition-transform duration-200">
                                                    {{ $country->emoji }} {{ $country->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">未設定</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($medicine->countries->count() > 0)
                                        <div class="space-y-1.5">
                                            @foreach($medicine->countries as $country)
                                                <div class="flex items-center space-x-1 text-sm text-[#0B1E26] whitespace-nowrap">
                                                    @if($country->pivot->price === null)
                                                        <span class="text-gray-400">価格不明</span>
                                                    @else
                                                        <span class="font-medium">{{ number_format($country->pivot->price) }}</span>
                                                        <span class="text-teal-600">{{ $country->pivot->currency_code }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('admin.medicines.edit', $medicine->id) }}" 
                                           class="text-teal-600 hover:text-emerald-500 flex items-center transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1 transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>編集</span>
                                        </a>
                                        <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-500 hover:text-red-600 flex items-center transition-colors duration-200 group" 
                                                    onclick="return confirm('削除してもよろしいですか？')">
                                                <svg class="w-4 h-4 mr-1 transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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

                @if($medicines->isEmpty())
                <div class="text-center py-16 bg-[#F2F2F2]">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-r from-teal-600 to-emerald-500 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-xl font-medium text-[#0B1E26] mb-2">登録されている薬はありません</p>
                    <p class="text-teal-600">「新規登録」ボタンから薬情報を追加してください</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 画像モーダル -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-auto bg-[#0B1E26]/70 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-lg max-w-3xl mx-auto shadow-2xl p-6 border border-gray-100">
            <!-- 閉じるボタン -->
            <button id="closeModal" class="absolute top-2 right-2 text-[#519A96] hover:text-teal-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <!-- モーダルコンテンツ -->
            <div class="text-center">
                <h3 id="modalTitle" class="text-lg font-semibold text-[#0B1E26] mb-4"></h3>
                <div class="bg-[#F2F2F2] p-1 rounded-lg border border-[#A0D3D9]/20">
                    <img id="modalImage" src="" alt="" class="mx-auto max-h-[70vh] object-contain">
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