// GULP
const gulp = require('gulp');

const {
  src, dest, watch, series,
} = require('gulp');

// JS
const babel = require('gulp-babel');

// SASS COMPILER
const sass = require('gulp-sass')(require('sass'));

// AUTOPREFIXER
const autoprefixer = require('gulp-autoprefixer');

// CSS MINIFIER
const cleanCSS = require('gulp-clean-css');

// SASS COMPILER // CSS MINIFIER // AUTOPREFIXER
function buildCSS() {
  return src('./build/scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ cascade: false }))
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(dest('./dist/css'));
}

function javascript() {
  return src('./build/js/**/*.js')
    .pipe(babel({
      presets: ['@babel/env'],
    }))
    .pipe(dest('./dist/js'));
}

function images() {
  return src('./build/images/**/*')
    .pipe(dest('./dist/images'));
}

function video() {
  return src('./build/video/**/*')
    .pipe(dest('./dist/video'));
}

// LIVE WATCH
function watchCSS() {
  watch('./build/**/*.scss', buildCSS);
  watch('./build/**/*.js', javascript);
}

exports.buildCSS = series(buildCSS);
exports.javascript = series(javascript);
exports.watchCSS = series(watchCSS);
exports.images = series(images);
exports.video = series(video);
exports.default = series(buildCSS, javascript, images, video, watchCSS);
