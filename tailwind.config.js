const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');


module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Arial', ...defaultTheme.fontFamily.sans],
            },
            colors: {
              danger: colors.rose,
              primary: colors.purple,
              success: colors.green,
              warning: colors.yellow,
              cprimary : "#202A42",
              csecondary: "#6f00a1"
          },
        },
    },

    plugins: [
      require('@tailwindcss/forms'),
    ],
};
