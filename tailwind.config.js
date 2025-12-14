import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        'bg-blue-500',
        'bg-slate-500',
        'bg-emerald-500',
        'bg-yellow-400',
        'bg-violet-500',
        'bg-cyan-500',
        'bg-red-400',
        'bg-gray-500',
        'bg-gray-400',
        'bg-indigo-400',
        'text-white',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
