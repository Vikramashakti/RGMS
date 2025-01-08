import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/ @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // change this to 'class' for manual control
    // other config settings...
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views//*.blade.php',
        './resources/js//*.js',   // Include JavaScript files for scanning
        './resources/css//*.css', // Ensure your CSS files are scanned
        './resources/views/**/*.vue', // Include Vue components (if applicable)
    ],

    theme: {
        extend: {
            colors: {
                lightblue: '#ADD8E6',  // Light blue color

            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};