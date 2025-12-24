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
                gambus: {
                    primary: '#4A3728',  // Coklat Tua (Warna Kayu/Kopi) - untuk Navbar & Tombol
                    secondary: '#D4A373', // Coklat Emas - untuk Aksen/Hover
                    bg: '#FEFAE0',       // Krem Putih Gading - untuk Background Halaman
                    text: '#2C1810',     // Coklat Sangat Tua - untuk Teks Judul
                }
            }
        },
    },

    plugins: [forms],
};
