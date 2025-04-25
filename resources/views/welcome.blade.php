<!DOCTYPE html>
<html class="text-base" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config("app.name", "MediNavi Asia") }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Scripts -->
  @vite(["resources/css/app.css", "resources/js/app.js"])

  <!-- モバイルメニュー用のスクリプト -->
  <script>
    function toggleMenu() {
      const mobileMenu = document.getElementById('mobile-menu');
      if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden');
      } else {
        mobileMenu.classList.add('hidden');
      }
    }
  </script>
</head>

<body class="bg-slate-50 font-sans text-base text-slate-800 antialiased">
  <div class="min-h-screen">
    <!-- ヘッダー -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <a class="flex items-center gap-3" href="/">
              <img class="h-6 w-6 object-contain sm:h-7 sm:w-7" src="{{ asset("images/logo/earth.png") }}"
                alt="MediNavi Asia Logo">
              <span class="text-lg font-bold text-white sm:text-xl">
                MediNavi Asia
              </span>
            </a>
          </div>

          <!-- デスクトップナビゲーション -->
          <nav class="hidden items-center space-x-2 sm:flex">
            <a class="rounded-md px-3 py-2 text-sm font-medium text-white/90 transition-colors hover:text-white"
              href="#features">特徴</a>
            <a class="rounded-md px-3 py-2 text-sm font-medium text-white/90 transition-colors hover:text-white"
              href="#about">サービス概要</a>
            <a class="rounded-md px-3 py-2 text-sm font-medium text-white/90 transition-colors hover:text-white"
              href="{{ route("login") }}">ログイン</a>
            <a class="ml-2 rounded-md bg-white/10 px-4 py-2 text-sm font-medium text-white backdrop-blur-sm transition-colors hover:bg-white/20"
              href="{{ route("register") }}">新規登録</a>
          </nav>

          <!-- モバイルメニューボタン -->
          <button class="text-white/90 hover:text-white sm:hidden" onclick="toggleMenu()">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>

          <!-- モバイルメニュー -->
          <div
            class="absolute inset-x-0 top-full hidden bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark p-4 shadow-lg sm:hidden"
            id="mobile-menu">
            <div class="flex flex-col space-y-2">
              <a class="rounded-md px-3 py-2 text-sm font-medium text-white/90 transition-colors hover:text-white"
                href="#features">特徴</a>
              <a class="rounded-md px-3 py-2 text-sm font-medium text-white/90 transition-colors hover:text-white"
                href="#about">サービス概要</a>
              <a class="rounded-md px-3 py-2 text-sm font-medium text-white/90 transition-colors hover:text-white"
                href="{{ route("login") }}">ログイン</a>
              <a class="rounded-md bg-white/10 px-4 py-2 text-sm font-medium text-white backdrop-blur-sm transition-colors hover:bg-white/20"
                href="{{ route("register") }}">新規登録</a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- ヒーローセクション -->
    <section class="relative bg-white">
      <div class="relative h-[500px] overflow-hidden lg:h-[600px]">
        <!-- グラデーションオーバーレイ -->
        <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-900/90 via-slate-800/75 to-transparent"></div>

        <!-- 画像装飾要素 -->
        <div class="absolute inset-0 z-0">
          <div class="absolute -right-12 -top-12 h-64 w-64 rounded-full bg-medinavi-blue/10 blur-3xl"></div>
          <div class="absolute -left-12 bottom-12 h-48 w-48 rounded-full bg-medinavi-blue-light/10 blur-2xl"></div>
        </div>

        <!-- 画像 -->
        <img class="absolute inset-0 h-full w-full object-cover" src="/images/hero-temple.jpg" alt="タイの伝統的な寺院"
          width="1920" height="1080" loading="eager">

        <!-- メインコンテンツ -->
        <div class="relative z-20 h-full">
          <div class="mx-auto flex h-full max-w-7xl items-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
              <span
                class="mb-6 inline-block rounded-full bg-white/10 px-4 py-1.5 text-base font-semibold text-white backdrop-blur-sm">
                アジアの市販薬情報をもっと身近に
              </span>
              <h1 class="mb-6 text-4xl font-bold leading-tight text-white sm:text-5xl md:text-6xl">
                MediNavi Asia
              </h1>
              <p class="mb-8 text-xl leading-relaxed text-white/90">
                アジア各国で販売されている市販薬の情報を簡単に検索・比較。<br class="hidden sm:block">
                旅行先でも安心して市販薬を探せるプラットフォームです。
              </p>
              <div class="flex flex-col gap-4 sm:flex-row">
                <a class="rounded-lg bg-white px-8 py-4 text-center text-lg font-semibold text-medinavi-blue shadow-lg transition-all hover:bg-white/90 hover:shadow-xl"
                  href="{{ route("register") }}">
                  無料で始める
                  <svg class="-mr-1 ml-2 inline-block h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                    </path>
                  </svg>
                </a>
                <a class="rounded-lg border-2 border-white/30 px-8 py-4 text-center text-lg text-white backdrop-blur-sm transition-all hover:bg-white/10"
                  href="#features">
                  詳しく見る
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 特徴セクション -->
    <section class="bg-slate-50 py-8 sm:py-24" id="features">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center sm:mb-16">
          <span
            class="mb-3 inline-block rounded-full bg-medinavi-blue/10 px-3 py-1 text-base font-semibold text-medinavi-blue">特徴</span>
          <h2 class="mb-4 text-3xl font-bold text-slate-800 sm:text-4xl">より安全に、より便利に</h2>
          <p class="mx-auto max-w-2xl text-base text-slate-600">MediNavi Asiaが提供する主な機能をご紹介します</p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
          <!-- 多言語対応 -->
          <div
            class="group relative overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
            <div class="relative h-48 overflow-hidden">
              <img class="h-full w-full scale-100 object-cover transition-transform duration-300 group-hover:scale-105"
                src="/images/languages.jpg" alt="多言語対応" loading="lazy">
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-6">
                <h3 class="text-lg font-bold text-white sm:text-xl">多言語対応</h3>
              </div>
            </div>
            <div class="relative">
              <div
                class="absolute -top-1 left-0 right-0 h-1 bg-gradient-to-r from-medinavi-blue via-medinavi-blue-light to-medinavi-blue opacity-75">
              </div>
              <div class="p-6">
                <div class="mb-4 flex items-center">
                  <div
                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-medinavi-blue/10 to-medinavi-blue-light/10 p-3 shadow-inner">
                    <svg class="h-7 w-7 text-medinavi-blue" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                      </path>
                    </svg>
                  </div>
                </div>
                <p class="text-base leading-relaxed text-slate-600">各国の市販薬の情報を日本語で提供。言語の壁を超えて必要な情報にアクセスできます。</p>
              </div>
            </div>
          </div>

          <!-- 詳細な情報提供 -->
          <div
            class="group relative overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
            <div class="relative h-48 overflow-hidden">
              <img class="h-full w-full scale-100 object-cover transition-transform duration-300 group-hover:scale-105"
                src="/images/medicine-info.jpg" alt="詳細な情報提供" loading="lazy">
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-6">
                <h3 class="text-lg font-bold text-white sm:text-xl">詳細な情報提供</h3>
              </div>
            </div>
            <div class="relative">
              <div
                class="absolute -top-1 left-0 right-0 h-1 bg-gradient-to-r from-medinavi-blue via-medinavi-blue-light to-medinavi-blue opacity-75">
              </div>
              <div class="p-6">
                <div class="mb-4 flex items-center">
                  <div
                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-medinavi-blue/10 to-medinavi-blue-light/10 p-3 shadow-inner">
                    <svg class="h-7 w-7 text-medinavi-blue" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                      </path>
                    </svg>
                  </div>
                </div>
                <p class="text-base leading-relaxed text-slate-600">成分、用法、注意事項など、市販薬に関する詳細な情報を分かりやすく提供します。</p>
              </div>
            </div>
          </div>

          <!-- 位置情報活用 -->
          <div
            class="group relative overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
            <div class="relative h-48 overflow-hidden">
              <img class="h-full w-full scale-100 object-cover transition-transform duration-300 group-hover:scale-105"
                src="/images/pharmacy.jpg" alt="位置情報活用" loading="lazy">
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-6">
                <h3 class="text-lg font-bold text-white sm:text-xl">位置情報活用</h3>
              </div>
            </div>
            <div class="relative">
              <div
                class="absolute -top-1 left-0 right-0 h-1 bg-gradient-to-r from-medinavi-blue via-medinavi-blue-light to-medinavi-blue opacity-75">
              </div>
              <div class="p-6">
                <div class="mb-4 flex items-center">
                  <div
                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-medinavi-blue/10 to-medinavi-blue-light/10 p-3 shadow-inner">
                    <svg class="h-7 w-7 text-medinavi-blue" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </div>
                </div>
                <p class="text-base leading-relaxed text-slate-600">現在地に基づいて、近くの薬局やその国で購入可能な市販薬を表示します。</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- サービス概要セクション -->
    <section class="bg-white py-16 sm:py-24" id="about">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-8 md:flex-row md:justify-between md:gap-12">
          <div class="w-full text-center md:w-1/2 md:text-left">
            <span
              class="mb-4 inline-block rounded-full bg-medinavi-blue/10 px-3 py-1.5 text-base font-semibold text-medinavi-blue sm:mb-6">サービス概要</span>
            <h2 class="mb-4 text-3xl font-bold leading-tight text-slate-800 sm:mb-6 sm:text-4xl">
              安心して市販薬を<br>探せるプラットフォーム
            </h2>
            <p class="mb-6 text-base leading-relaxed text-slate-600 sm:mb-8">
              旅行先で体調を崩したとき、言葉の壁に阻まれることなく適切な市販薬を見つけることができます。MediNavi Asiaは、アジア各国の医薬品情報を一元化し誰もが安心して医療にアクセスできる環境を提供します。
            </p>
            <ul class="space-y-3 sm:space-y-4">
              <li class="flex items-center p-3">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-medinavi-blue/10">
                  <svg class="h-5 w-5 text-medinavi-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span class="ml-3 text-base font-medium text-slate-700">アジア各国の市販薬情報を順次拡大中</span>
              </li>
              <li class="flex items-center p-3">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-medinavi-blue/10">
                  <svg class="h-5 w-5 text-medinavi-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span class="ml-3 text-base font-medium text-slate-700">看護師監修の安心情報</span>
              </li>
              <li class="flex items-center p-3">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-medinavi-blue/10">
                  <svg class="h-5 w-5 text-medinavi-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span class="ml-3 text-base font-medium text-slate-700">24時間365日アクセス可能</span>
              </li>
            </ul>
          </div>
          <div class="w-full md:w-1/2">
            <div class="relative">
              <div class="overflow-hidden rounded-xl bg-white shadow-xl">
                <img class="h-auto w-full object-cover" src="/images/welcome_image.png" alt="アプリのデモ画像"
                  loading="lazy">
              </div>
              <div class="absolute -bottom-3 -right-3 rounded-full bg-white p-3 shadow-lg">
                <svg class="h-8 w-8 text-medinavi-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                  </path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 免責事項セクション -->
    <section class="bg-slate-50 py-12">
      <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-xl bg-white p-6 shadow-lg sm:p-8">
          <h3 class="mb-4 text-xl font-bold text-slate-800">免責事項</h3>
          <div class="space-y-4 text-sm text-slate-600">
            <p>
              1. 利用者は、本サービスは情報提供サービスであり、医療に関する診断、診断の補助、診療又は治療行為のいずれにも相当しないことを十分認識するものとします。
            </p>
            <p>
              2. 利用者は、以下事項を十分認識した上で、自己の判断及び責任において本サービスを利用するものとします。
            </p>
            <ul class="ml-6 list-disc space-y-2">
              <li>自身の症状等について、本サービスで提供される情報に依拠して判断又は対処するのではなく、医師等の専門家に相談の上、専門的な診察等を受けるようにしてください。</li>
              <li>薬局、ドラッグストア等でOTC医薬品・健康食品・サプリメント等を購入する場合には、本サービスにおいて提供される情報に依拠して判断、対処するのではなく、薬剤師等の専門スタッフに相談の上、購入するようにしてください。</li>
            </ul>
            <p>
              3. 当社は、本サービスで提供する情報について、その正確性、真実性、有効性、有用性、最新性、合法性等を確保すべく細心の注意を払っておりますが、これらを保証するものではありません。
            </p>
            <p>
              4. 当社は、本サービスの提供の中断、停止、利用不能または変更、本サービスの利用によるデータの消失、機器の故障・損傷、その他本サービスに関連して利用者が被った損害につき、一切責任を負わないものとします。
            </p>
            <p class="font-medium text-amber-600">
              ※このサービスはポートフォリオ展示目的で作成されたもので、実際のサービスではありません。掲載されている医薬品情報は参考情報であり、医療目的での使用は想定されておりません。
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTAセクション -->
    <section class="bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark py-16 sm:py-20">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-6 md:flex-row md:justify-between md:gap-8">
          <div class="w-full text-center md:w-2/3 md:text-left">
            <h2 class="mb-2 text-2xl font-bold text-white sm:text-3xl">アジアでの市販薬探しを、もっと簡単に。</h2>
            <p class="text-white/90">今すぐ無料で始めましょう。登録は60秒で完了します。</p>
          </div>
          <div class="w-full text-center md:w-1/3 md:text-right">
            <a class="inline-block rounded-lg bg-white/20 px-6 py-3 font-semibold text-white shadow-lg hover:bg-white/30 hover:shadow-xl"
              href="{{ route("register") }}">
              無料で始める
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- フッター -->
    <footer class="bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark">
      <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
          <!-- ロゴと説明 -->
          <div class="col-span-1 lg:col-span-2">
            <div class="flex items-center">
              <a class="flex items-center gap-3" href="/">
                <img class="h-6 w-6 object-contain sm:h-7 sm:w-7" src="{{ asset("images/logo/earth.png") }}"
                  alt="MediNavi Asia Logo">
                <span class="text-lg font-bold text-white sm:text-xl">
                  MediNavi Asia
                </span>
              </a>
            </div>
            <p class="mt-4 max-w-md text-base leading-relaxed text-white/80">
              アジア各国の市販薬情報を一元化し、誰もが安心して医療にアクセスできる環境を提供します。言語の壁を超えて、必要な医療情報をお届けします。
            </p>
            <p class="mt-2 text-sm text-white/70">
              ※このアプリはポートフォリオ展示目的で、実際のサービスではありません。<br>
              ※掲載されている医薬品情報は参考情報です。実際の服用については専門家に相談してください。
            </p>
          </div>

          <!-- リンク -->
          <div class="space-y-4">
            <h3 class="text-base font-semibold uppercase text-white">サービス</h3>
            <ul class="space-y-2">
              <li>
                <a class="text-base text-white/80 transition-colors hover:text-white" href="#features">特徴</a>
              </li>
              <li>
                <a class="text-base text-white/80 transition-colors hover:text-white" href="#about">サービス概要</a>
              </li>
              <li>
                <a class="text-base text-white/80 transition-colors hover:text-white"
                  href="{{ route("login") }}">ログイン</a>
              </li>
              <li>
                <a class="text-base text-white/80 transition-colors hover:text-white"
                  href="{{ route("register") }}">新規登録</a>
              </li>
            </ul>
          </div>

          <!-- リーガル -->
          <div class="space-y-4">
            <h3 class="text-base font-semibold uppercase text-white">法的情報</h3>
            <ul class="space-y-2">
              <li>
                <a class="text-base text-white/80 transition-colors hover:text-white" href="#">プライバシーポリシー</a>
              </li>
              <li>
                <a class="text-base text-white/80 transition-colors hover:text-white" href="#">利用規約</a>
              </li>
              <li>
                <a class="text-base text-white/80 transition-colors hover:text
