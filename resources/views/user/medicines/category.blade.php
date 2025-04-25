<x-app-layout>
  <div class="min-h-screen bg-[#F8FAFC] py-6">
    <div class="mx-auto max-w-[1280px] px-6 sm:px-8 lg:px-12">
      <div class="mb-8">
        <h1 class="flex items-center text-2xl font-bold text-[#1E293B]">
          <span>薬のカテゴリー一覧</span>
        </h1>
      </div>

      <div class="rounded-xl border border-[#E2E8F0] bg-white p-6 shadow-lg">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($sortedCategories as $category)
            <a class="flex items-center justify-between rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-3 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md"
              href="{{ route("medicines.index", ["category" => $category]) }}">
              <span class="font-medium">{{ $category }}</span>
              <svg class="h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          @endforeach
        </div>

        <div class="mt-8 flex justify-center space-x-4">
          <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md"
            href="{{ route("medicines.search") }}">
            <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            商品名で検索
          </a>
          <a class="flex items-center rounded-lg border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-2.5 text-[#1E293B] transition-all duration-200 hover:bg-white hover:shadow-md"
            href="{{ route("dashboard") }}">
            <svg class="mr-2 h-5 w-5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
