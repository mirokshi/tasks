const workboxPlugin = require('workbox-webpack-plugin')
const mix = require('laravel-mix')
const replace = require('replace-in-file')
const path = require('path')
const publicDir = 'public'
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').then(() => {
  replace.sync({
    // SEE: https://github.com/JeffreyWay/laravel-mix/issues/1717
    // FIXME:   Workaround for laravel-mix placeing '//*.js' at the begining of JS filesystem

    files: path.normalize(`${publicDir}/service-worker/precache-manifest.*.js`),
    from: /\/\//gu,
    to: '/'
  })
})
  .extract()
  .sourceMaps(false)
  .sass('resources/sass/app.scss', 'public/css')// .sourceMaps(false) -> Disable source maps in production
if (mix.inProduction()) {
  mix.version()
}

mix.webpackConfig({
  plugins: [
    // Options: https://developers.google.com/web/tools/workbox/modules/workbox-webpack-plugin
    new workboxPlugin.InjectManifest({
      swSrc: 'public/src-sw.js', // more control over the caching
      swDest: 'sw.js', // the service-worker file name
      importsDirectory: 'service-worker' // have a dedicated folder for sw files
    })
  ]
})
