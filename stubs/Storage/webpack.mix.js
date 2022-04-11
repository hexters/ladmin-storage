const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/js/app.js', 'js/storage.js')
    .sass( __dirname + '/Resources/sass/app.scss', 'css/storage.css');

if (mix.inProduction()) {
    mix.version();
}
