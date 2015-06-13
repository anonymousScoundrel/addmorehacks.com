"use strict";
// Include gulp
var gulp = require('gulp');

// Include plugins
var jshint = require('gulp-jshint');
var stylish = require('jshint-stylish');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var notify = require('gulp-notify');
var sourceMaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

// Lint task
gulp.task('lint', function () {
    return gulp.src('js/dev.*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'));
});

// Compile Sass
gulp.task('sass', function () {
    return gulp.src('scss/*.scss')
        .pipe(sass({
            includePaths: [
                'bower_components/compass-mixins/lib'
            ]
        }))
        .pipe(autoprefixer())
        .pipe(sourceMaps.init())
        .pipe(minifycss({"keepSpecialComments": "*"}))
        .pipe(sourceMaps.write())
        .pipe(gulp.dest('.'))
        .pipe(notify({"message": "Sass task complete"}));
});

// Concat and minify JS
gulp.task('scripts', function () {
    return gulp.src('js/*.js')
        .pipe(concat('jjdesign.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('.'))
});

// Watch files for changes
gulp.task('watch', function () {
    gulp.watch('js/*.js', ['lint', 'scripts']);
    gulp.watch('scss/*.scss', ['sass']);
});

// Default task
gulp.task('default', ['lint', 'sass', 'scripts', 'watch']);
