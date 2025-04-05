# View ファイル構成説明

このディレクトリには、MediNavi Asia アプリケーションのビューファイルが含まれています。

## ディレクトリ構造

### 1. レイアウト関連 (`layouts/`)

-   **app.blade.php**: アプリケーションの基本レイアウト（ログイン後）
-   **guest.blade.php**: ゲスト用の基本レイアウト（ログイン前）
-   **navigation.blade.php**: ナビゲーションバー（お気に入りリンクを含む）

### 2. ユーザー向け薬情報 (`user/medicines/`)

-   **index.blade.php**: 薬の一覧・検索結果表示画面（お気に入りボタンを含む）
-   **search.blade.php**: 薬の検索フォーム画面
-   **category.blade.php**: 薬のカテゴリ一覧画面

### 3. お気に入り関連 (`user/favorites/`)

-   **index.blade.php**: お気に入りに登録した薬の一覧表示画面

### 4. 管理者関連 (`admin/`)

-   **index.blade.php**: 管理者ダッシュボード（薬の一覧・削除機能）
-   **medicines/create.blade.php**: 薬の登録フォーム画面

### 5. 認証関連 (`auth/`)

-   ログイン、登録、パスワードリセットなど認証関連の画面

### 6. コンポーネント (`components/`)

-   ボタン、入力フォーム、モーダルなど再利用可能な UI 部品

### 7. その他

-   **dashboard.blade.php**: ユーザーダッシュボード
-   **welcome.blade.php**: アプリケーショントップページ

## コントローラーとの連携

-   **ユーザー向け薬情報** - `MedicineController`が担当

    -   `search()` → `user.medicines.search`
    -   `index()` → `user.medicines.index`
    -   `category()` → `user.medicines.category`

-   **お気に入り機能** - `FavoriteController`が担当

    -   `index()` → `user.favorites.index`（お気に入り一覧表示）
    -   `store()` → お気に入りに追加し、元のページにリダイレクト
    -   `destroy()` → お気に入りから削除し、元のページにリダイレクト

-   **管理者関連** - `AdminController`が担当
    -   `index()` → `admin.index`
    -   `create()` → `admin.medicines.create`
    -   `store()` → データベースに保存し、`admin.index`にリダイレクト
    -   `destroy()` → データを削除し、`admin.index`にリダイレクト
