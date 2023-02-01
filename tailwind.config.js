/** @type {import('tailwindcss').Config} */

module.exports = {
    mode: "jit",
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            container: {
                center: true,
            },
            screens: {
                monitor: { min: "2223.98px" },
                "large-laptop": { max: "1535.98px" },
                laptop: { max: "1399.98px" },
                "small-laptop": { max: "1279.98px" },
                "wide-tablet": { max: "1023.98px" },
                tablet: { max: "768.98px" },
                "wide-mobile": { max: "640.98px" },
                mobile: { max: "479.98px" },
            },
            inset: {
                "10/12": "83.333333%",
            },
            gridTemplateRows: {
                "[auto,auto,1fr]": "auto auto 1fr",
            },
            height: {
                "9/12": "75%",
            },
        },
    },
    fontFamily: {
        body: [
            "Inter",
            "ui-sans-serif",
            "system-ui",
            "-apple-system",
            "system-ui",
            "Segoe UI",
            "Roboto",
            "Helvetica Neue",
            "Arial",
            "Noto Sans",
            "sans-serif",
            "Apple Color Emoji",
            "Segoe UI Emoji",
            "Segoe UI Symbol",
            "Noto Color Emoji",
        ],
        sans: [
            "Inter",
            "ui-sans-serif",
            "system-ui",
            "-apple-system",
            "system-ui",
            "Segoe UI",
            "Roboto",
            "Helvetica Neue",
            "Arial",
            "Noto Sans",
            "sans-serif",
            "Apple Color Emoji",
            "Segoe UI Emoji",
            "Segoe UI Symbol",
            "Noto Color Emoji",
        ],
    },
    variants: {
        extend: {},
    },
    plugins: [require("autoprefixer")],
};
