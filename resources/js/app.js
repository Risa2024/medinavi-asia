import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// 位置情報管理クラス
// できること
// 1. 現在地から国情報を自動取得
// 2. 手動で国を選択
// 3. 選択した国情報の保存と表示
// 4. エラー処理とユーザーへの通知
class LocationManager {//位置情報（Location）を管理（Manage）
    // コンストラクタ：初期化処理。必要な要素や状態を取得し、初期化メソッドを呼び出す
    constructor() {
        // 画面要素の取得
        this.currentLocationElement = document.getElementById('current-location');  // 現在の国名表示用
        this.locationToggle = document.getElementById('location-toggle');
        this.statusLabel = document.getElementById('location-status-label');
        this.errorContainer = document.getElementById('location-error-container'); // エラー表示用

        // 状態管理
        // localStorageを使って、ページをリロードしても状態を保持する
        this.savedCountry = localStorage.getItem('selectedCountry');              // 保存された国情報
        this.locationType = localStorage.getItem('locationType') || 'manual';     // 取得方法（自動/手動）
        this.isLocationEnabled = false;                                          // 位置情報の有効状態

        // 初期化処理を実行
        this.init();
    }

    // 初期化処理：画面表示やイベントリスナーの登録を行う
    init() {
        // 保存された国情報があれば表示
        if (this.savedCountry) {
            this.updateLocationDisplay(this.savedCountry);
        } else {
            this.updateLocationDisplay('位置情報が無効です');
        }

        // イベントリスナーの設定
        if (this.locationToggle) {
            this.locationToggle.addEventListener('change', () => {
                if (this.locationToggle.checked) {
                    this.statusLabel.textContent = 'ON';
                    this.statusLabel.style.color = 'green'; // ONは緑色
                    this.enableLocation();
                } else {
                    this.statusLabel.textContent = 'OFF';
                    this.statusLabel.style.color = 'red'; // OFFは赤色
                    this.currentLocationElement.textContent = '位置情報が無効です';
                }
            });
        }
    }

    // 位置情報の取得処理
    async enableLocation() {//enable（有効にする＋location（位置情報）...関数定義
        if (!navigator.geolocation) {
            this.currentLocationElement.textContent = '位置情報が使えません';
            return;
        }
        try {
            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            });
            const { latitude, longitude } = position.coords;

            // ここでAPIを使って国名・都市名を取得
            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=10&addressdetails=1`
            );
            const data = await response.json();

            if (data.address && data.address.country) {
                const country = data.address.country;
                const city = data.address.city || data.address.town || data.address.village || '';
                const location = city ? `${country}（${city}）` : country;
                this.currentLocationElement.textContent = location;
            } else {
                this.currentLocationElement.textContent = '国情報が取得できませんでした';
            }
        } catch (e) {
            this.currentLocationElement.textContent = '取得できませんでした';
        }
    }
    // 国情報の取得と表示
    async getCountryFromCoordinates(latitude, longitude) {
        try {
            // Nominatim APIを使用して逆ジオコーディング
            const response = await fetch(//fetch(...)→インターネット上のサーバーにデータを取りに行くJavaScriptの関数
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=10&addressdetails=1`
            );
            const data = await response.json();//.json() で「JavaScriptで使いやすい形（オブジェクト）」に変換

            if (data.address && data.address.country) {
                // 国名と都市名を取得して表示
                const country = data.address.country;
                const city = data.address.city || data.address.town || data.address.village || '';
                const location = city ? `${country}（${city}）` : country;
                this.updateLocationDisplay(location);
                localStorage.setItem('selectedCountry', location);
            }
        } catch (error) {
            this.showError('国情報の取得に失敗しました');
            console.error('国情報の取得に失敗しました:', error);
        }
    }

    // UI更新メソッド
    // 国名表示の更新
    updateLocationDisplay(location) {
        if (this.currentLocationElement) {
            this.currentLocationElement.textContent = location;
        }
    }

    // 位置情報をオフにする処理
    disableLocation() {
        // 位置情報の状態をリセット
        this.isLocationEnabled = false;
        this.locationType = 'manual';
        localStorage.setItem('locationType', 'manual');
        localStorage.removeItem('selectedCountry');

        // 表示を更新
        this.updateLocationDisplay('位置情報が無効です');
    }
}

// ===== 初期化 =====
// ページ読み込み完了時にLocationManagerを初期化
document.addEventListener('DOMContentLoaded', () => {
    new LocationManager();
});
