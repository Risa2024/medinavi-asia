<x-app-layout>
    <div class="py-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-[1280px] mx-auto px-6 sm:px-8 lg:px-12">
            <!-- ヘッダーセクション -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">
                        🏥 MediNavi Asia 管理画面
                    </h1>
                </div>
                <a href="{{ route('admin.medicines.create') }}" 
                   class="group relative inline-flex items-center px-6 py-3 text-sm font-medium text-white transition-all duration-200 ease-in-out bg-gradient-to-r from-indigo-600 to-blue-500 rounded-lg hover:from-indigo-500 hover:to-blue-400 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="absolute inset-0 w-full h-full rounded-lg opacity-0 group-hover:opacity-20 transition-opacity duration-200 ease-in-out bg-white"></span>
                    <svg class="w-5 h-5 mr-2 transform transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    新規登録
                </a>
            </div>

            <!-- 検索フォーム -->
            <div class="mb-8 bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.index') }}" method="GET" class="flex items-center space-x-4">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="薬品名で検索..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                    </div>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg hover:from-blue-400 hover:to-indigo-400 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        検索
                    </button>
                </form>
            </div>

            <!-- 検索結果メッセージ -->
            @if(request('search'))
            <div class="mb-6 text-gray-700 bg-blue-50 px-6 py-3 rounded-lg border border-blue-100">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>「<span class="font-medium text-blue-700">{{ request('search') }}</span>」の検索結果: <span class="font-medium text-blue-700">{{ $medicines->count() }}</span>件</span>
                </div>
            </div>
            @endif

            <!-- 登録薬のリスト -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- 薬情報テーブル -->
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[200px]">薬品名</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[100px]">画像</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[120px]">カテゴリー</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[180px]">販売国</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[150px]">価格</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-[100px]">編集</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($medicines as $medicine)
                            <tr class="transform transition-colors duration-200 hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    <div class="text-sm font-medium text-gray-900 truncate max-w-[180px]">{{ $medicine->name }}</div>
                                </td>
                                <td class="px-4 py-2">
                                    @if($medicine->image_path)
                                        <div class="w-16 h-16 bg-white p-1 rounded-lg flex items-center justify-center shadow-sm border">
                                            <img src="{{ asset('storage/' . $medicine->image_path) }}"
                                                 alt="{{ $medicine->name }}"
                                                 class="w-full h-full object-contain cursor-pointer hover:opacity-80 hover:scale-105 transition-all duration-200"
                                                 onclick="openImageModal('{{ asset('storage/' . $medicine->image_path) }}', '{{ $medicine->name }}')" />
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-gray-50 p-1 rounded-lg flex items-center justify-center shadow-sm border">
                                            <span class="text-gray-400 text-xs">画像なし</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <div class="w-[130px]">
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-indigo-50 to-blue-50 text-indigo-700 border border-indigo-100">
                                            {{ $medicine->category }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    @if($medicine->countries->count() > 0)
                                        <div class="flex flex-wrap gap-1.5 max-w-[160px]">
                                            @foreach($medicine->countries as $country)
                                                @php
                                                    $countryEmojis = [
                                                        'インドネシア' => '🇮🇩',
                                                        'タイ' => '🇹🇭',
                                                        'マレーシア' => '🇲🇾',
                                                        'ベトナム' => '🇻🇳',
                                                    ];
                                                    $emoji = $countryEmojis[$country->name] ?? '🌏';
                                                @endphp
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 whitespace-nowrap">
                                                    {{ $emoji }} {{ $country->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">未設定</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($medicine->countries->count() > 0)
                                        <div class="space-y-1.5">
                                            @foreach($medicine->countries as $country)
                                                <div class="flex items-center space-x-1 text-sm text-gray-700 whitespace-nowrap">
                                                    @if($country->pivot->price === null)
                                                        <span class="text-gray-400">価格不明</span>
                                                    @else
                                                        <span class="font-medium">{{ number_format($country->pivot->price) }}</span>
                                                        <span class="text-gray-500">{{ $country->pivot->currency_code }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm font-medium">
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('admin.medicines.edit', $medicine->id) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 flex items-center transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>編集</span>
                                        </a>
                                        <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 flex items-center transition-colors duration-200" 
                                                    onclick="return confirm('削除してもよろしいですか？')">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="text-center py-16 bg-gray-50">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-xl font-medium text-gray-600 mb-2">登録されている薬はありません</p>
                    <p class="text-gray-500">「新規登録」ボタンから薬情報を追加してください</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 画像モーダル -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-md flex items-center justify-center transition-all duration-300 ease-in-out opacity-0">
        <div class="absolute top-4 right-4 z-10">
            <button onclick="closeImageModal()" aria-label="Close"
                    class="text-red-600 text-4xl font-bold hover:text-red-700 transition-transform duration-300 ease-in-out hover:rotate-90 bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center">
                &times;
            </button>
        </div>

        <div class="relative max-w-[90%] md:max-w-4xl flex flex-col items-center space-y-6 px-4">
            <img id="modalImage"
                 class="max-w-full max-h-[70vh] rounded-xl shadow-xl border border-white/20 transition-transform duration-300 ease-in-out scale-95" />

            <div id="caption"
                 class="text-white text-center text-lg md:text-xl font-semibold tracking-wide px-2">
            </div>

            <button onclick="closeImageModal()"
                    class="px-6 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl backdrop-blur-md border border-white/20 transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>閉じる</span>
            </button>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, imageName) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const captionText = document.getElementById('caption');
            
            modalImg.src = imageSrc;
            captionText.innerHTML = imageName;
            
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            // アニメーション用にすこし遅らせる
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalImg.classList.add('scale-100');
                modalImg.classList.remove('scale-95');
            }, 10);
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            
            modal.classList.remove('opacity-100');
            modalImg.classList.remove('scale-100');
            modalImg.classList.add('scale-95');
            
            // アニメーション後に非表示にする
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        // モーダルの外側をクリックしても閉じるようにする
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // ESCキーでも閉じるようにする
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('imageModal').classList.contains('hidden')) {
                closeImageModal();
            }
        });
    </script>
</x-app-layout>