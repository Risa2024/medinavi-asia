import js from "@eslint/js";
import globals from "globals";
import markdown from "@eslint/markdown";
import css from "@eslint/css";
import { defineConfig } from "eslint/config";


export default defineConfig([
  { files: ["**/*.{js,mjs,cjs}"], plugins: { js }, extends: ["js/recommended"] },
  { files: ["**/*.{js,mjs,cjs}"], languageOptions: { globals: globals.browser } },
  { files: ["**/*.md"], plugins: { markdown }, language: "markdown/gfm", extends: ["markdown/recommended"] },
  { files: ["**/*.css"], plugins: { css }, language: "css/css", extends: ["css/recommended"] },
  {
    rules: {
      "no-unused-vars": "error",// 意味：未使用の変数を定義するとエラー
      "no-undef": "error",// 意味：未定義の変数を使用するとエラー
      "eqeqeq": "error", // 意味：厳密等価演算子を使用する
      "prefer-const": "error", // 意味：再代入されない変数はconstで宣言する
      "no-extra-semi": "error", // 意味：余分なセミコロンを許可しない
    },
  },
]);
