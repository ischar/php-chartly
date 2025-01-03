import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js"
    ],

    theme: {
        extend: {
            colors: {
                light: {
                    bg: {
                        primary: "#f7f7f7",
                        input: "#f3f4f6",
                        card: "#ffffff",
                        button: "#3b82f6",
                        border: "#dddddd",
                        tr: "#bfdbfe",
                    },
                    fg: {
                        primary: "#111827",
                        input: "#5A5A5A",
                        button: "#f7f7f7",
                        nav: "#3b82f6",
                    },
                },
                dark: {
                    bg: {
                        primary: "#1f1f1f",
                        input: "#333333",
                        card: "#292929",
                        button: "#2563eb",
                        border: "#e0e0e0",
                        tr: "#1e40af",
                    },
                    fg: {
                        primary: "#f9fafb",
                        input: "#d1d5db",
                        button: "#f9fafb",
                        nav: "#2563eb",
                    },
                },
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("@tailwindcss/line-clamp")],
};
