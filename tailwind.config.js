import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                upnez: {
                    blue: '#2563EB',
                    navy: '#0F172A',
                    orange: '#F97316',
                    success: '#16A34A',
                    warning: '#D97706',
                    danger: '#DC2626',
                },
            },
            borderRadius: {
                upnez: '12px',
            },
            transitionDuration: {
                150: '150ms',
            },
        },
    },

    plugins: [forms],
};
