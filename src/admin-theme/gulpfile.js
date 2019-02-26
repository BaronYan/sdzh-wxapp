'use strict'
const gulp = require('gulp')
const SASS = require('gulp-sass')

const src = './src/scss/**/*.scss'
const dist = '../../public/static/css'

function sass(cb) {
  gulp.src(src)
  .pipe(SASS())
  .pipe(gulp.dest(dist))
  cb()
}



exports.default = gulp.series(sass)