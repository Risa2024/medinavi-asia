<x-app-layout>
  <div class="min-h-screen bg-[#F2F2F2] py-6">
    <div class="mx-auto max-w-[1280px] px-6 sm:px-8 lg:px-12">
      <div class="mb-8">
        <h1 class="flex items-center text-2xl font-bold text-[#0B1E26]">
          <span>薬の商品名で検索</span>
        </h1>
        <p class="mt-2 text-[#365359]">探している薬の名前を入力してください</p>
      </div>

      <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-lg">
        <!-- 検索フォーム -->
        <form class="mx-auto max-w-2xl" action="{{ route("medicines.index") }}" method="GET">
          <div class="flex items-center">
            <div class="relative flex-grow">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
              <input
                class="w-full rounded-lg border border-gray-200 py-3 pl-10 pr-4 transition-all duration-200 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#519A96]"
                name="query" type="text" value="{{ $query ?? "" }}" placeholder="例: パナドール、タイレノール">
            </div>
            <button
              class="ml-4 transform rounded-lg bg-[#519A96] px-6 py-3 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-teal-600 hover:shadow-lg"
              type="submit">
              検索
            </button>
          </div>
        </form>

        <div class="mt-12 flex justify-center space-x-4">
          <a class="flex items-center rounded-lg border border-[#A0D3D9]/30 bg-[#F2F2F2] px-5 py-2.5 text-[#0B1E26] transition-all duration-200 hover:bg-white hover:shadow-md"
            href="{{ route("medicines.category") }}">
            <svg class="mr-2 h-5 w-5 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            カテゴリから探す
          </a>
          <a class="flex items-center rounded-lg border border-[#A0D3D9]/30 bg-[#F2F2F2] px-5 py-2.5 text-[#0B1E26] transition-all duration-200 hover:bg-white hover:shadow-md"
            href="{{ route("dashboard") }}">
            <svg class="mr-2 h-5 w-5 text-[#519A96]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
              </path>
            </svg>
            トップに戻る
          </a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
