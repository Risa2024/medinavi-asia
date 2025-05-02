import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// 位置情報の取得と国情報の特定を行うクラス
class LocationManager {
    // コンストラクタ：初期化処理。必要な要素や状態を取得し、初期化メソッドを呼び出す
    constructor() {
        // 画面上に現在の国名や位置情報の状態を表示するための要素を取得
        this.currentLocationElement = document.getElementById('current-location');
        // 「自動取得中」「手動選択中」など、今どの方法で国が決まっているかを表示するバッジ用の要素を取得
        this.locationStatusElement = document.getElementById('location-status');
        // 「国を手動で選択」ボタンの要素を取得し、クリック時に国選択モーダルを出すために使う
        this.changeCountryBtn = document.getElementById('change-country-btn');
        // 「現在地から国を自動取得」ボタンの要素を取得し、クリック時に位置情報APIを呼び出すために使う
        this.enableLocationBtn = document.getElementById('enable-location-btn');
        // エラーメッセージをユーザーに見せるための表示エリア（div）を取得
        this.errorContainer = document.getElementById('location-error-container');
        // 以前に選択・取得した国情報があればlocalStorageから取得し、ページ再読み込み後も前回の国を表示できるようにする
        this.savedCountry = localStorage.getItem('selectedCountry');
        // 位置情報の取得方法（自動 or 手動）をlocalStorageから取得。前回どちらで国を決めたかを覚えておき、UIの状態を再現するため
        this.locationType = localStorage.getItem('locationType') || 'manual'; // 'auto' or 'manual'
        // 位置情報が現在有効かどうかを管理するフラグ。ボタンの有効/無効や状態表示の切り替えに使う
        this.isLocationEnabled = false;

        // 上記で取得した要素や値を使って、初期表示やイベント登録などの初期化処理を行う
        this.init();
    }

    // 初期化処理：画面表示やイベントリスナーの登録を行う
    init() {
        // 保存された国情報があれば表示、なければ「位置情報が無効です」と表示
        if (this.savedCountry) {
            this.updateLocationDisplay(this.savedCountry);
        } else {
            this.updateLocationDisplay('位置情報が無効です');
        }

        // 位置情報の取得方法（自動/手動）バッジの表示を更新
        this.updateLocationStatus();

        // 「国を手動で選択」ボタンのクリックイベント登録
        this.changeCountryBtn.addEventListener('click', () => {
            this.locationType = 'manual'; // 手動選択モードに切り替え
            localStorage.setItem('locationType', 'manual');
            this.updateLocationStatus();
            this.showCountrySelector(); // 国選択モーダルを表示
        });

        // 「現在地から国を自動取得」ボタンのクリックイベント登録
        if (this.enableLocationBtn) {
            this.enableLocationBtn.addEventListener('click', () => {
                this.locationType = 'auto'; // 自動取得モードに切り替え
                localStorage.setItem('locationType', 'auto');
                this.updateLocationStatus();
                this.enableLocation(); // 位置情報の取得処理を実行
            });
        }
    }

    // 位置情報の取得方法（自動/手動）バッジの表示を更新する
    updateLocationStatus() {
        if (this.locationStatusElement) {
            const statusText = this.locationType === 'auto' ? '自動取得中' : '手動選択中';
            const statusColor = this.locationType === 'auto' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600';

            this.locationStatusElement.textContent = statusText;
            this.locationStatusElement.className = `inline-flex items-center rounded-full ${statusColor} px-2.5 py-0.5 text-xs font-medium`;
        }
    }

    // トースト通知を画面右下に表示する（成功・エラーのフィードバック用）
    showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        toast.className = `fixed bottom-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-up`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('animate-fade-out-down');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // 位置情報APIを使って現在地を取得し、国情報を取得・表示する
    async enableLocation() {
        if (!navigator.geolocation) {
            // ブラウザが位置情報API非対応の場合のエラー表示
            this.showError('お使いのブラウザでは位置情報が利用できません');
            this.updateLocationDisplay('位置情報が無効です');
            return;
        }

        try {
            // ボタンを無効化し、二重押し防止
            this.isLocationEnabled = true;
            this.enableLocationBtn.disabled = true;
            this.enableLocationBtn.classList.add('opacity-50', 'cursor-not-allowed');

            // 位置情報の取得（非同期）
            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
            });

            // 緯度・経度から国情報を取得
            const { latitude, longitude } = position.coords;
            await this.getCountryFromCoordinates(latitude, longitude);

            // 成功時はトースト通知を表示し、ボタンを再度有効化
            this.showToast('現在地から国情報を取得しました', 'success');
            this.enableLocationBtn.disabled = false;
            this.enableLocationBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } catch (error) {
            // 失敗時はエラーメッセージを表示し、ボタンを再度有効化
            this.isLocationEnabled = false;
            this.enableLocationBtn.disabled = false;
            this.enableLocationBtn.classList.remove('opacity-50', 'cursor-not-allowed');

            // エラー内容に応じてメッセージを切り替え
            let errorMessage = '位置情報の取得に失敗しました';
            if (error.code === 1) {
                errorMessage = '位置情報の利用が許可されていません。ブラウザの設定から許可してください。';
            } else if (error.code === 2) {
                errorMessage = '位置情報を取得できませんでした。インターネット接続を確認してください。';
            } else if (error.code === 3) {
                errorMessage = '位置情報の取得がタイムアウトしました。再度お試しください。';
            }

            this.showError(errorMessage);
            this.updateLocationDisplay('位置情報が無効です');

            // 自動取得に失敗したら手動モードに切り替え、バッジも更新
            this.locationType = 'manual';
            localStorage.setItem('locationType', 'manual');
            this.updateLocationStatus();
        }
    }

    // 緯度・経度からNominatim APIを使って国情報を取得し、画面に表示・保存する
    async getCountryFromCoordinates(latitude, longitude) {
        try {
            // Nominatim APIにリクエストを送り、逆ジオコーディングで国名・都市名を取得
            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=10&addressdetails=1`
            );
            const data = await response.json();

            if (data.address && data.address.country) {
                // 取得できたら「国名（都市名）」の形で表示・保存
                const country = data.address.country;
                const city = data.address.city || data.address.town || data.address.village || '';
                const location = city ? `${country}（${city}）` : country;
                this.updateLocationDisplay(location);
                localStorage.setItem('selectedCountry', location);
            }
        } catch (error) {
            // APIエラー時の処理
            this.showError('国情報の取得に失敗しました');
            console.error('国情報の取得に失敗しました:', error);
        }
    }

    // 画面上の国名表示を更新する
    updateLocationDisplay(location) {
        if (this.currentLocationElement) {
            this.currentLocationElement.textContent = location;
        }
    }

    // 国選択モーダルを表示し、ユーザーが国を選べるようにする
    showCountrySelector() {
        // 1. 国名リストを定義（本来はDBから取得したいが、ここではハードコーディング）
        // なぜ？ → モーダルでユーザーに選択肢として表示するため
        const countries = [
            'タイ',
            'ベトナム',
            'マレーシア',
            'インドネシア'
        ];

        // 2. モーダルの背景（黒い半透明）を作成
        // なぜ？ → モーダルを画面中央に表示し、他の操作をできなくするため
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';

        // 3. モーダル本体（白いボックス）を作成
        // なぜ？ → 国リストやタイトルを表示するため
        const content = document.createElement('div');
        content.className = 'bg-white rounded-lg p-6 max-w-md w-full mx-4';

        // 4. モーダルのタイトルを作成
        // なぜ？ → ユーザーに「国を選択」することを伝えるため
        const title = document.createElement('h3');
        title.className = 'text-lg font-bold mb-4';
        title.textContent = '国を選択';

        // 5. 国リストを表示するエリアを作成
        // なぜ？ → ボタンを縦に並べて表示するため
        const list = document.createElement('div');
        list.className = 'space-y-2';

        // 6. 各国ごとにボタンを作成し、クリック時の処理を設定
        // なぜ？ → ユーザーが国を選択できるようにするため
        countries.forEach(country => {
            const button = document.createElement('button');
            button.className = 'w-full text-left px-4 py-2 rounded hover:bg-slate-100';
            button.textContent = country;
            button.onclick = () => {
                // 国を選択したときの処理
                // 1. 画面の国名表示を更新
                // 2. localStorageに保存（リロードしても覚えておくため）
                // 3. トーストで「選択した」ことを通知
                // 4. モーダルを閉じる
                this.updateLocationDisplay(country);
                localStorage.setItem('selectedCountry', country);
                this.showToast(`${country}を選択しました`, 'success');
                modal.remove();
            };
            list.appendChild(button);
        });

        // 7. モーダル本体にタイトルとリストを追加
        content.appendChild(title);
        content.appendChild(list);

        // 8. モーダル背景に本体を追加し、bodyに追加して表示
        modal.appendChild(content);
        document.body.appendChild(modal);

        // 9. モーダルの外側（黒い部分）をクリックしたらモーダルを閉じる
        // なぜ？ → 直感的な操作のため
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }

    // エラーメッセージを画面に表示する
    showError(message) {
        if (this.errorContainer) {
            // エラー用のdivを作成し、デザインを整えて表示
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-50 border-l-4 border-red-400 p-4';
            errorDiv.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">${message}</p>
                    </div>
                </div>
            `;

            this.errorContainer.innerHTML = '';
            this.errorContainer.appendChild(errorDiv);

            setTimeout(() => {
                errorDiv.remove();
            }, 5000);
        }
    }
}

// ページの読み込みが完了したらLocationManagerを初期化
// なぜ？ → DOM要素が揃ってからでないとgetElementByIdで取得できないため
// これにより、画面の各要素とJSの処理が正しく連携する

document.addEventListener('DOMContentLoaded', () => {
    new LocationManager();
});
