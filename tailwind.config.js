module.exports = {
    purge: [],
    theme: {
        extend: {
            width: {
                "96": "18rem",
                "97": "0.6rem"
            }
        },
        spinner: theme => ({
            default: {
                color: "#dae1e7", // color you want to make the spinner
                size: "1em", // size of the spinner (used for both width and height)
                border: "2px", // border-width of the spinner (shouldn't be bigger than half the spinner's size)
                speed: "500ms" // the speed at which the spinner should rotate
            }
        })

        /*pagination: theme => ({
            color: theme("colors.purple.600")
        })*/
    },
    variants: {},
    plugins: [
        require("tailwindcss-spinner")()
        /*require("tailwindcss-plugins/pagination")*/
    ]
};