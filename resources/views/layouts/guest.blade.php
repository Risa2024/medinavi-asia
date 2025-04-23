<!--認証関連（ログイン、新規登録、パスワードリセットなど）の共通レイアウトを定義しているページ-->
<!--使用ページ：
・ログインページ
・新規登録ページ
・パスワードリセットページ
・メール確認ページ-->
<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config("app.name", "Laravel") }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Scripts -->
  @vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="font-noto-sans-jp h-full bg-[#F2F2F2] antialiased">
  <div class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
    <div>
      <a class="group flex items-center" href="/">
        <img class="mr-2 h-8 w-8 object-contain opacity-100 sm:h-9 sm:w-9" src="{{ asset("images/logo/eath2.png") }}"
          alt="MediNavi Asia Logo">
        <span class="text-xl font-bold text-slate-800">Medi<span class="medinavi-blue-light">Navi</span> <span
            class="medinavi-blue-light">Asia</span></span>
      </a>
    </div>

    <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
      {{ $slot }}<!--各ページの内容（ログインフォームや登録フォームなど）が入る-->
    </div>
  </div>
</body>

</html>
