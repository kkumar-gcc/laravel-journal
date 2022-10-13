const defaultTheme = require('tailwindcss/defaultTheme');
function withOpacity(variableName) {
    return ({ opacityValue }) => {
        if (opacityValue !== undefined) {
            return `rgba(var(${variableName}), ${opacityValue})`
        }
        return `rgb(var(${variableName}))`
    }
}
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            textColor: {
                skin: {
                    base: withOpacity('--color-base'),
                    50: withOpacity('--color-50'),
                    100: withOpacity('--color-100'),
                    200: withOpacity('--color-200'),
                    300: withOpacity('--color-300'),
                    500: withOpacity('--color-500'),
                    600: withOpacity('--color-600'),
                    700: withOpacity('--color-700'),
                },
            },
            backgroundColor: {
                skin: {
                    base: withOpacity('--color-base'),
                    50: withOpacity('--color-50'),
                    100: withOpacity('--color-100'),
                    200: withOpacity('--color-200'),
                    300: withOpacity('--color-300'),
                    500: withOpacity('--color-500'),
                    600: withOpacity('--color-600'),
                    700: withOpacity('--color-700'),
                },
            },
            borderColor: {
                skin: {
                    base: withOpacity('--color-base'),
                    50: withOpacity('--color-50'),
                    100: withOpacity('--color-100'),
                    200: withOpacity('--color-200'),
                    300: withOpacity('--color-300'),
                    500: withOpacity('--color-500'),
                    600: withOpacity('--color-600'),
                    700: withOpacity('--color-700'),
                },
            },
            ringColor: {
                skin: {
                    base: withOpacity('--color-base'),
                    50: withOpacity('--color-50'),
                    100: withOpacity('--color-100'),
                    200: withOpacity('--color-200'),
                    300: withOpacity('--color-300'),
                    500: withOpacity('--color-500'),
                    600: withOpacity('--color-600'),
                    700: withOpacity('--color-700'),
                },
            },
            placeholderColor: {
                skin: {
                    base: withOpacity('--color-base'),
                    50: withOpacity('--color-50'),
                    100: withOpacity('--color-100'),
                    200: withOpacity('--color-200'),
                    300: withOpacity('--color-300'),
                    500: withOpacity('--color-500'),
                    600: withOpacity('--color-600'),
                    700: withOpacity('--color-700'),
                },
            },
            gradientColorStops: {
                skin: {
                    hue: withOpacity('--color-700'),
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('@tailwindcss/line-clamp'),],
};
