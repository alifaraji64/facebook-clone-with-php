//process.env.NODE_ENV = 'production'
console.log('env', process.env.NODE_ENV)
module.exports = {
  purge: [
    './*.php',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
