/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./public/**/*.php', './app/views/**/*.php'],
    safelist: ['text-skyblue', 'text-neon', 'hover:text-skyblue'],
    theme: {
        extend: {
            colors: {
                // neon: '#00FFC6',
                // skyblue: '#1F8EFD',
                // darkgray: '#1A1C1E',
            }
        }
    },
    plugins: [],
};