const { series, src, dest, parallel } = require("gulp");
const gulp = require("gulp");
const terser = require("gulp-terser");
const concat = require("gulp-concat");
const minifyCSS = require("gulp-minify-css");
const rename = require("gulp-rename");
const gulpSass = require('gulp-sass');
const watch = require('gulp-watch');
const gulpif = require('gulp-if');
const parseArgs = require('minimist')

var opt = {
  string: 'env',
  default: { env: 'prod' }
};

var options = parseArgs(process.argv.slice(2), opt);

function clean(cb) {
  // body omitted
  cb();
}

function build(cb) {
  // body omitted
  cb();
}

function baseJs(cb) {
  return src([
    "node_modules/jquery/dist/jquery.js",
    "node_modules/popper.js/dist/umd/popper.js",
    "node_modules/@fortawesome/fontawesome-free/js/all.js",
    "node_modules/bootstrap/dist/js/bootstrap.min.js",
    "node_modules/vue/dist/vue.min.js",
    "node_modules/vuelidate/dist/vuelidate.min.js",
    'node_modules/sweetalert2/dist/sweetalert2.min.js'
  ])
    .pipe(concat("base.min.js"))
    .pipe(terser())
    .pipe(dest("wwwroot/assets/js/"));
  cb();
}

function baseCSS(cb) {
  return src([
    "node_modules/bootstrap/dist/css/bootstrap.css",
    "node_modules/@fortawesome/fontawesome-free/css/all.css",
    'node_modules/sweetalert2/dist/sweetalert2.min.css'
  ])
    .pipe(minifyCSS())
    .pipe(concat("base.min.css"))
    .pipe(dest("wwwroot/assets/css"));
  cb();
}

function copyWebFront(cb) {
  return src(["node_modules/@fortawesome/fontawesome-free/webfonts/*"])
    .pipe(dest("wwwroot/assets/webfonts"));
  cb();
}

function copyModuleImg(cb) {
  return src([
    "src/mod/*/Resoure/images/*"
  ]).pipe(rename(function (path) {
    var dirname = path.dirname.split('/')
    path.dirname = dirname[0] + '/'
  })).pipe(dest('wwwroot/assets/images/'));

  cb()
}


function modScss(cb) {
  return src('src/mod/*/Resoure/scss/*.scss')
    .pipe(gulpSass({
      outputStyle: 'compressed'
    }))
    .pipe(rename(function (path) {
      path.dirname = ''
      path.basename += '.min'
      path.extname = '.css'
    }))
    .pipe(dest('wwwroot/assets/css'))

  cb()
}

function modJs(cb) {
  return src('src/mod/*/Resoure/js/*.js')
    .pipe(rename(function (path) {
      path.dirname = ''
      path.basename += '.min'
      path.extname = '.js'
    }))
    .pipe(dest('wwwroot/assets/js'))
}

function develop(cb) {
  gulp.watch('src/mod/*/Resoure/scss/*.scss', gulp.parallel(modScss))
  gulp.watch('src/mod/*/Resoure/js/*.js', gulp.parallel(modJs))
  gulp.watch('src/mod/*/Resoure/images/*', gulp.parallel(copyModuleImg))
  cb()
}

if (options.env == 'prod') {
  exports.build = build;
  exports.default = series(baseJs, baseCSS, copyWebFront, modScss, modJs, copyModuleImg);
} else {
  exports.build = build;
  exports.default = series(baseJs, baseCSS, copyWebFront, develop, copyModuleImg)
}