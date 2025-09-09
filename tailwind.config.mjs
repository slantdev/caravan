/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // This is the crucial part!
    "./**/*.php", // Scan all .php files in the theme
    "./src/**/*.js", // Scan all .js files in the src folder
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
