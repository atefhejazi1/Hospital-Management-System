import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#0162e8',
                    dark:    '#031b4e',
                    light:   '#e8f0fe',
                },
            },
        },
    },

    /*
     * Disable Tailwind's preflight (base CSS reset) so it coexists peacefully
     * alongside the Bootstrap 4 CSS already loaded in Dashboard layouts.
     * All utility classes still work — only the base reset is suppressed.
     */
    corePlugins: {
        preflight: false,
    },

    /*
     * Safelist: classes assembled dynamically in PHP arrays inside Blade files.
     * Tailwind's scanner finds literal strings in PHP arrays, but the pattern
     * rule here provides a safety net for colour variants used via variables.
     */
    safelist: [
        { pattern: /^(bg|text|border)-(blue|emerald|amber|rose|purple|teal|red|slate)-(50|100|400|500|600|700)$/ },
    ],

    plugins: [forms],
};
