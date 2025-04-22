import js from "@eslint/js";
import globals from "globals";
import markdown from "@eslint/markdown";
import css from "@eslint/css";
import { defineConfig } from "eslint/config";
import eslintConfigPrettier from "eslint-config-prettier";

export default defineConfig([
    { files: ["**/*.{js,mjs,cjs}"], plugins: { js }, extends: ["js/recommended"] },
    { files: ["**/*.{js,mjs,cjs}"], languageOptions: { globals: globals.browser } },
    {
        files: ["**/*.md"],
        plugins: { markdown },
        language: "markdown/gfm",
        extends: ["markdown/recommended"],
    },
    { files: ["**/*.css"], plugins: { css }, language: "css/css", extends: ["css/recommended"] },
    {
        rules: {
            noUnusedVars: "error", // 意味：未使用の変数を定義するとエラー
            noUndef: "error", // 意味：未定義の変数を使用するとエラー
            eqeqeq: "error", // 意味：厳密等価演算子を使用する
            preferConst: "error", // 意味：再代入されない変数はconstで宣言する
            noExtraSemi: "error", // 意味：余分なセミコロンを許可しない
        },
    },
    eslintConfigPrettier, //Prettierのフォーマットルールと競合する,ESLintのルールを無効化
]);
