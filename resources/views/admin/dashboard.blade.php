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
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:border-medinavi-blue hover:text-medinavi-blue">
          ホーム</div>
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:border-medinavi-blue hover:text-medinavi-blue">
          お気に入り</div>
        <div
          class="cursor-pointer whitespace-nowrap rounded-md border-b-[3px] border-medinavi-blue px-3 py-2 text-sm font-medium text-slate-600 transition-colors duration-300 hover:text-medinavi-blue">
          管理画面</div>
      </nav>
    </div>
  </x-slot>

  <div class="min-h-screen bg-slate-50">
    <main class="px-4 py-8 sm:px-6 lg:px-8">
      <!-- 統計情報セクション -->
      <section class="mb-12">
        <div class="mx-auto max-w-6xl">
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- 総ユーザー数 -->
            <div class="overflow-hidden rounded-lg bg-white shadow-md">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="flex items-center">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                      </path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-bold text-slate-800">総ユーザー数</h3>
                    <p class="text-2xl font-bold text-medinavi-blue">{{ $totalUsers }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- 総薬品数 -->
            <div class="overflow-hidden rounded-lg bg-white shadow-md">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="flex items-center">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                      </path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-bold text-slate-800">総薬品数</h3>
                    <p class="text-2xl font-bold text-medinavi-blue">{{ $totalMedicines }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- 総カテゴリ数 -->
            <div class="overflow-hidden rounded-lg bg-white shadow-md">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="flex items-center">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                      </path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-bold text-slate-800">総カテゴリ数</h3>
                    <p class="text-2xl font-bold text-medinavi-blue">{{ $totalCategories }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- 総国数 -->
            <div class="overflow-hidden rounded-lg bg-white shadow-md">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="flex items-center">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                      </path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-bold text-slate-800">総国数</h3>
                    <p class="text-2xl font-bold text-medinavi-blue">{{ $totalCountries }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 管理メニューセクション -->
      <section class="mb-12">
        <div class="mx-auto max-w-6xl">
          <div class="mb-8 text-center">
            <span
              class="mb-3 inline-block rounded-full bg-medinavi-blue/10 px-3 py-1 text-sm font-semibold text-slate-800">管理メニュー</span>
            <h2 class="mb-4 text-2xl font-bold text-slate-800 sm:text-3xl">管理機能</h2>
          </div>

          <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-3">
            <!-- 薬管理 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="{{ route("admin.medicines.index") }}">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                      </path>
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">薬管理</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">薬の追加、編集、削除を行います。</p>
                <div
                  class="flex w-full items-center justify-center rounded-lg bg-medinavi-blue px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:bg-medinavi-blue-dark hover:shadow-xl">
                  管理画面へ
                  <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </a>

            <!-- カテゴリ管理 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="{{ route("admin.categories.index") }}">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                      </path>
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">カテゴリ管理</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">カテゴリの追加、編集、削除を行います。</p>
                <div
                  class="flex w-full items-center justify-center rounded-lg bg-medinavi-blue px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:bg-medinavi-blue-dark hover:shadow-xl">
                  管理画面へ
                  <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </a>

            <!-- 国管理 -->
            <a class="transform overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
              href="{{ route("admin.countries.index") }}">
              <div class="h-2 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-light"></div>
              <div class="p-4 sm:p-6">
                <div class="mb-4 flex items-center sm:mb-5">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 border border-slate-200 sm:h-14 sm:w-14">
                    <svg class="h-6 w-6 text-medinavi-blue sm:h-7 sm:w-7" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                      </path>
                    </svg>
                  </div>
                  <h3 class="ml-3 text-lg font-bold text-slate-800 sm:text-xl">国管理</h3>
                </div>
                <p class="mb-4 text-sm text-slate-600 sm:mb-5 sm:text-base">国の追加、編集、削除を行います。</p>
                <div
                  class="flex w-full items-center justify-center rounded-lg bg-medinavi-blue px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-300 hover:bg-medinavi-blue-dark hover:shadow-xl">
                  管理画面へ
                  <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </a>
          </div>
        </div>
      </section>
    </main>
  </div>
</x-app-layout>
