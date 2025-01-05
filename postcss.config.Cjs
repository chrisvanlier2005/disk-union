module.exports = {
    plugins: [
        require('tailwindcss'),
        require('postcss-css-variables')({
            // Options for postcss-css-variables
            preserve: false, // Replace variables with static values
        }),
        require('@csstools/postcss-oklab-function')({
            preserve: false,
            subFeatures: {
                displayP3: false
            }
        }),
        require('@csstools/postcss-color-mix-function')({
            preserve: false,
        }),
    ],
};
