// tailwind.config.js

import defaultTheme from 'tailwindcss/defaultTheme';

module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/views/layouts/app.blade.php', // Tambahkan ini
    './app/Livewire/**/*.php', // Tambahkan ini jika kamu pakai class-based
    './resources/views/livewire/**/*.blade.php', // Tambahkan ini untuk lebih spesifik
  ],

  theme: {
    extend: {
      colors: {
        softBg: '#F9F9F9',
        softPink: '#F88E86',
        tealAccent: '#13988A',
        textGray: '#757575',
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [require('@tailwindcss/forms')],
};