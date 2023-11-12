import daisyui from "daisyui"

module.exports = {
    plugins: [require("@tailwindcss/typography"), require("daisyui")],
    daisyui: {
        themes: ["cupcake", "dark", "cmyk"],
    },
}