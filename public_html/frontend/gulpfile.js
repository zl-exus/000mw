/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');
var changed = require('gulp-changed');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync');
var concat = require('gulp-concat');

// stylesheet
gulp.task('scss', function () {
    return gulp.src('scss/styles.scss')
            .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(autoprefixer({
                browsers: ['last 2 versions', 'ios 6', 'android 4'],
                cascade: false
            }))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest('css'))
            .pipe(cssmin())
            .pipe(rename({suffix: '.min'}))
            .pipe(gulp.dest('css'))
            .pipe(browserSync.reload({stream: true}));
});

//scripts
gulp.task('js-main', function () {
    return gulp.src('js/main.js')
            .pipe(uglify())
            .pipe(rename({suffix: '.min'}))
            .pipe(gulp.dest('js'));
});

//concat
gulp.task('scripts', function() {
   return gulp.src([
       'js/vendor/modernizr-3.6.0.min.js',
       'libs/jquery/dist/jquery.min.js',
       'libs/bootstrap/dist/js/bootstrap.min.js'
   ])
           .pipe(concat('libs.min.js'))
           .pipe(uglify())
           .pipe(gulp.dest('js'))
});

//browser-sync
gulp.task('browser-sync', function() {
   browserSync({
       server: true
   });
});
// watcher
gulp.task('watcher', ['browser-sync', 'scss'], function () {
    gulp.watch(['scss/*.scss'], ['scss']); // scss 
    gulp.watch('js/main.js', ['js-main']); // js-main
    gulp.watch('css/*.css', browserSync.reload);
    gulp.watch('*.html', browserSync.reload);
    gulp.watch('js/*.js', browserSync.reload);
});


gulp.task('default', ['watcher']);

//need create build