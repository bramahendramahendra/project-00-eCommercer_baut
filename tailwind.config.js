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
                'baut-color-red-100': '#8B0000',
                'baut-color-red-200': '#C70000',
                'baut-color-red-300': '#E63434',
                'baut-color-red-400': '#371f29',
            }
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),
    ],
};
