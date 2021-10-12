const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const { blue } = require('tailwindcss/colors');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors: {
            green: colors.green,
            blue: colors.blue,
            sky: colors.sky,
            red: colors.red,
            amber: colors.amber,
            black: colors.black,
            white: colors.white,
            pink:{
                lighter: '#ebd1e1',
                light: '#EAB3D1',
                DEFAULT: '#E483B4',
                dark: '#A11355',
            },
            aqua:{
                ligther: '#e6fffe',
                light: '#b3fffc',
                DEFAULT: '#00ccc5',//'#00e6de', //00A19B
                dark: '#009994',
            }
        },
        extend: {
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
                logo: ['Montserrat'],
            },
        },
    },

    variants: {
        extend: {
            width: ['responsive', 'hover', 'focus'],
            outline: ['group-focus'],
            opacity: ['disabled'],
            textColor:['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
