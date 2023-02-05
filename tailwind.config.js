/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        'anp-blue': '#1647e7',
        'anp-blue-dark': '#1440d0',
        'anp-blue-bright': '#2d59e9'
      }
    },
  },
  plugins: [],
}
