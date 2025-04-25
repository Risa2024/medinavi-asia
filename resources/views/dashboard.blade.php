<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
      <div class="flex items-center">
        <div class="flex flex-shrink-0 items-center">
          <div
            class="mr-3 flex h-12 w-12 items-center justify-center overflow-hidden rounded-full bg-white border border-slate-200">
            <img class="h-9 w-9 object-contain" src="{{ asset("images/logo/logo_dark.png") }}"
              alt="MediNavi Asia Logo">
          </div>
          <span class="text-xl font-bold text-slate-800">Medi<span class="text-medinavi-blue">Navi</span> <span
              class="text-medinavi-blue-light">Asia</span></span>
        </div>
      </div>
      <nav class="flex items-center space-x-6 overflow-x-auto pb-2 sm:pb-0">
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-medinavi-blue px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:text-medinavi-blue">
          ホーム</div>
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:border-medinavi-blue hover:text-medinavi-blue">
          お気に入り</div>
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:border-medinavi-blue hover:text-medinavi-blue">
          管理画面</div>
      </nav>
    </div>
  </x-slot>

  <div class="min-h-screen bg-slate-50">
    <main class="px-4 py-8 sm:px-6 lg:px-8">
      <!-- 検索セクション -->
      <section class="mb-12">
        <div class="mb-8 text-center">
          <span
            class="mb-3 inline-block rounded-full bg-medinavi-blue/10 px-3 py-1 text-sm font-semibold text-slate-800">お薬を探す</span>
          <h2 class="mb-4 text-2xl font-bold text-slate-800 sm:text-3xl">カテゴリや商品名から探す</h2>
          <p class="mx-auto max-w-2xl text-lg text-slate-600 sm:text-xl">検索方法を選んでください</p>
        </div>

        <div class="mx-auto max-w-6xl">
          <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2">
            <!-- 種類から検索 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="{{ route("medicines.category") }}">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">種類から検索</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">頭痛薬、風邪薬などカテゴリで薬を探せます。症状からぴったりの薬を見つけましょう。</p>
                <div class="mb-4 flex justify-center">
                  <img class="h-auto w-36 object-contain sm:w-48 md:w-64" src="/images/medicine1.jpg" alt="薬の種類から検索">
                </div>
                <div class="mt-4">
                  <div
                    class="flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:from-medinavi-blue-dark hover:to-medinavi-blue hover:shadow-xl">
                    カテゴリから探す
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </a>

            <!-- 商品名で検索 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="{{ route("medicines.search") }}">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">商品名で検索</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">
                  薬の名前がわかっている場合は、商品名で直接検索できます。正確かつ素早く薬を見つけられます。</p>
                <div class="mb-4 flex justify-center">
                  <img class="h-auto w-36 object-contain sm:w-48 md:w-64" src="/images/medicine2.jpg" alt="薬の種類から検索">
                </div>
                <div class="mt-4">
                  <div
                    class="flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:from-medinavi-blue-dark hover:to-medinavi-blue hover:shadow-xl">
                    商品名で検索
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </section>

      <!-- 現在地・位置情報セクション -->
      <section class="mb-12">
        <div class="mx-auto max-w-6xl">
          <div class="overflow-hidden rounded-lg bg-white shadow-md">
            <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
            <div class="p-4 sm:p-8">
              <div class="flex flex-col items-center gap-6 md:flex-row md:gap-8">
                <!-- 左側：コンテンツ -->
                <div class="z-10 w-full text-slate-800 md:w-1/2">
                  <div class="mb-4 flex items-center">
                    <div
                      class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                      <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      </svg>
                    </div>
                    <h2 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">位置情報ベースの検索</h2>
                  </div>
                  <div class="mb-6">
                    <div class="mb-3 inline-flex items-center rounded-full bg-medinavi-blue/10 px-3 py-1.5">
                      <div class="mr-2 h-2 w-2 rounded-full bg-medinavi-blue"></div>
                      <p class="text-sm font-medium text-slate-800 sm:text-base" id="current-location">タイ, バンコク</p>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-600 sm:text-base">
                      位置情報を有効にすると、現在いる国で販売されている薬だけを検索できます。旅行先でも地域に合った薬情報にアクセスできます。</p>
                  </div>

                  <button
                    class="flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:from-medinavi-blue-dark hover:to-medinavi-blue hover:shadow-xl sm:w-auto">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
                    </svg>
                    位置情報を有効にする
                  </button>
                </div>

                <!-- 右側：イラスト -->
                <div class="flex w-full items-center justify-center md:w-1/2">
                  <div class="relative w-full max-w-xs">
                    <div class="relative rounded-xl bg-medinavi-blue/10 p-4 sm:p-6">
                      <div class="mb-4 flex justify-center">
                        <div class="relative">
                          <div class="rounded-full bg-white p-3 border border-slate-200">
                            <svg class="h-6 w-6 text-medinavi-blue sm:h-8 sm:w-8" fill="none"
                              stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                              </path>
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                          </div>
                        </div>
                      </div>
                      <div class="space-y-2 sm:space-y-3">
                        <div class="mx-auto h-1.5 w-3/4 rounded-full bg-medinavi-blue/30"></div>
                        <div class="mx-auto h-1.5 w-2/3 rounded-full bg-medinavi-blue/30"></div>
                        <div class="mx-auto h-1.5 w-1/2 rounded-full bg-medinavi-blue/30"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</x-app-layout>
