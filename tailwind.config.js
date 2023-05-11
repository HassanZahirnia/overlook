const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./resources/views/**/*.blade.php'],
    darkMode: 'class',
    theme: {
        extend: {
            boxShadow: {
                'top': '0 -26px 25px 15px rgba(0, 0, 0, 0.7)',
            }
        },
    },
    corePlugins: {
        preflight: false,
    },
    plugins: [],
}
