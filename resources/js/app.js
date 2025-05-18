import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// 位置情報管理クラス（MVP用に超シンプル化）
class LocationManager {
    constructor() {
        this.autoCountryElement = document.getElementById('auto-country');
        this.init();
    }

    init() {
        this.enableLocation();
    }

    async enableLocation() {
        if (!navigator.geolocation) {
            this.updateLocationDisplay('位置情報が使えません');
            return;
        }
        try {
            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            });
            const { latitude, longitude } = position.coords;
            fetch(`/api/get-country?lat=${latitude}&lng=${longitude}`)
                .then(response => response.json())
                .then(data => {
                    if (data.country && data.country_id) {
                        const country = data.country;
                        this.updateLocationDisplay(country);
                        // 国IDを設定
                        const countryId = data.country_id;
                        localStorage.setItem('selected_country_id', countryId);
                        localStorage.setItem('selected_country_name', country);
                        updateSearchLinks(countryId);
                    } else {
                        // 対応外の国の場合はALLモード
                        this.updateLocationDisplay('全ての国');
                        selectCountry('ALL', 'all');
                    }
                })
                .catch(error => {
                    this.updateLocationDisplay('位置情報の取得に失敗しました');
                    selectCountry('ALL', 'all');
                });
        } catch (e) {
            this.updateLocationDisplay('取得できませんでした');
        }
    }

    updateLocationDisplay(location) {
        if (this.autoCountryElement) {
            this.autoCountryElement.textContent = location;
        }
    }
}

// 国を選択する関数
function selectCountry(countryId, countryName) {
    localStorage.setItem('selected_country_id', countryId);
    localStorage.setItem('selected_country_name', countryName);
    updateSearchLinks(countryId);
}

// 検索リンクを更新する関数
function updateSearchLinks(countryId) {
    const searchLinks = document.querySelectorAll('.search-link');
    searchLinks.forEach(link => {
        const url = new URL(link.href);
        url.searchParams.set('country_id', countryId);
        link.href = url.toString();
    });
}

// ===== 初期化 =====
document.addEventListener('DOMContentLoaded', () => {
    new LocationManager();
});

function updateManualCountry() {
    const select = document.getElementById('country-combobox');
    document.getElementById('manual-country').textContent = select.value || '未選択';
}
