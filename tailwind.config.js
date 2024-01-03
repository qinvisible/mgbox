import daisyui from "daisyui"

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    daisyui: {
        themes: ["light", "dark", "cupcake"],
    },
    plugins: [daisyui],
  }
