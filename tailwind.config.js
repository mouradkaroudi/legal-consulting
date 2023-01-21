const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

console.log(defaultTheme.fontFamily)

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/suleymanozev/**/*.blade.php'
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
            fontFamily: {
                sans: ['"Vazirmatn", sans-serif', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                fade: 'fade 1s ease-in-out',
            },
            keyframes: theme => ({
                fade: {
                    '0%': { opacity: theme('opacity.40') },
                    '100%': { opacity: theme('opacity.100') },
                },
            }),

        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
