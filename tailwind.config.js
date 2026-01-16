import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'bnhs-blue': {
                    DEFAULT: '#0038a8',
                    50: '#e6ebf5',
                    100: '#ccd7eb',
                    200: '#99afd7',
                    300: '#6687c3',
                    400: '#335faf',
                    500: '#0038a8',
                    600: '#002d86',
                    700: '#002265',
                    800: '#001743',
                    900: '#000b22',
                },
                'bnhs-gold': {
                    DEFAULT: '#fcd116',
                    50: '#fffbe6',
                    100: '#fef7cc',
                    200: '#fdee99',
                    300: '#fce666',
                    400: '#fcdd33',
                    500: '#fcd116',
                    600: '#caa711',
                    700: '#977d0d',
                    800: '#655308',
                    900: '#322a04',
                },
            },
        },
    },

    plugins: [forms],
};
