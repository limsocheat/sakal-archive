const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Noto Sans Khmer', 'Noto Sans', ...defaultTheme.fontFamily.sans],
            },
        },

        fontFamily: {
            sans: ['Noto Sans Khmer', 'Noto Sans', 'sans-serif'],
            serif: ['Noto Serif Khmer', 'Noto Serif', 'serif'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'),
        require('flowbite/plugin'),
    ],
};
