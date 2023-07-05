import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import prose from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        {
            pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ['sm', 'md', 'lg', 'xl', '2xl'],
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'fit': {
                    'black': '#1E1F30',
                    'light-blue': '#4CC9F0',
                    'magenta': '#F72585',
                    'purple-blue': '#4361EE',
                    'dark-blue': '#3A0CA3',
                    'purple': '#7209B7',
                    'dark-gray': '#61626E',
                    'lighter-gray': '#F9F9F9'
                }
            },
        },
    },

    plugins: [forms, prose],
};
