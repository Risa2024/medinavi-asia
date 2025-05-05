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
            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=10&addressdetails=1`
            );
            const data = await response.json();
            if (data.address && data.address.country) {
                const country = data.address.country;
                this.updateLocationDisplay(country);
            } else {
                this.updateLocationDisplay('国情報が取得できませんでした');
            }
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

// ===== 初期化 =====
document.addEventListener('DOMContentLoaded', () => {
    new LocationManager();
});

function updateManualCountry() {
    const select = document.getElementById('country-combobox');
    document.getElementById('manual-country').textContent = select.value || '未選択';
}
