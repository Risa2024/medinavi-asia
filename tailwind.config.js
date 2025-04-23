import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Noto Sans JP"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "medinavi-blue": "#0012B3", //ベースカラー
                "medinavi-blue-light": "#1A2BC3", //ベースカラーの軽いバージョン
                "medinavi-blue-dark": "#000A66", //ベースカラーの濃いバージョン
            },
        },
    },

    plugins: [forms],
};
