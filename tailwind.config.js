const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors:{
            pink: {
                lighter: '#eab3d1',
                light: '#e483b4',
                DEFAULT: '#dd5a9c',
                dark: '#a11355'
            },
            turquoise:{
                DEFAULT: '#00a19b'
            },
            white:{
                DEFAULT: '#FFF',
            },
            black:{
                DEFAULT: '#000',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
