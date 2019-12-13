var browserSync     = require('browser-sync').create(),
    gulp            = require('gulp'),
    autoprefixer    = require('gulp-autoprefixer'),
    cleanCSS        = require('gulp-clean-css'),
    concat          = require('gulp-concat'),
    plumber         = require('gulp-plumber'),
    rename          = require('gulp-rename'),
    sass            = require('gulp-sass'),
    sourcemaps      = require('gulp-sourcemaps');

var onError = function (err) {
    console.log( 'An error occurred:', err.message );
    this.emit('end');
};

gulp.task( 'css', function () {
    return gulp.src('css/sass/*.scss')
        .pipe( plumber({ errorHandler: onError }) )
        .pipe( sourcemaps.init() )
        .pipe( sass() )
        .pipe( autoprefixer( {
            browsers: ['last 2 versions'],
            cascade: false
        } ) )
        .pipe( cleanCSS() )
        .pipe( rename( {
            suffix: '.min'
        } ) )
        .pipe( sourcemaps.write('./') )
        .pipe( gulp.dest('css') )
        .pipe( browserSync.stream()) ;
} );

gulp.task( 'browser-sync', function() {
    browserSync.init({
        files: ['./**/(*.php|*.min.css)', '!./**/(*.map)'],
        // port: 3000, // uncomment to use another port other than 3000 default
        // proxy: 'testingsiteurl.loc',
        tunnel: 'testingsiteurl', // for use if not on same wifi
        // online: false,
        open: false,
        // browser: ['firefox']
        // logLevel: 'debug'
    } );

    gulp.watch( 'css/**/*.scss', ['css'] );

});

// Default Task
gulp.task( 'default', ['browser-sync'] );

// run default task for compiling all files
gulp.task( 'compile', ['css'] );
var browserSync     = require('browser-sync').create(),
    gulp            = require('gulp'),
    autoprefixer    = require('gulp-autoprefixer'),
    cleanCSS        = require('gulp-clean-css'),
    concat          = require('gulp-concat'),
    plumber         = require('gulp-plumber'),
    rename          = require('gulp-rename'),
    sass            = require('gulp-sass'),
    sourcemaps      = require('gulp-sourcemaps');

var onError = function (err) {
    console.log( 'An error occurred:', err.message );
    this.emit('end');
};

gulp.task( 'css', function () {
    return gulp.src('css/sass/*.scss')
        .pipe( plumber({ errorHandler: onError }) )
        .pipe( sourcemaps.init() )
        .pipe( sass() )
        .pipe( autoprefixer( {
            browsers: ['last 2 versions'],
            cascade: false
        } ) )
        .pipe( cleanCSS() )
        .pipe( rename( {
            suffix: '.min'
        } ) )
        .pipe( sourcemaps.write('./') )
        .pipe( gulp.dest('css') )
        .pipe( browserSync.stream()) ;
} );

gulp.task( 'browser-sync', function() {
    browserSync.init({
        files: ['./**/(*.php|*.min.css)', '!./**/(*.map)'],
        // port: 3000, // uncomment to use another port other than 3000 default
        // proxy: 'testingsiteurl.loc',
        tunnel: 'testingsiteurl', // for use if not on same wifi
        // online: false,
        open: false,
        // browser: ['firefox']
        // logLevel: 'debug'
    } );

    gulp.watch( 'css/**/*.scss', ['css'] );

});

// Default Task
gulp.task( 'default', ['browser-sync'] );

// run default task for compiling all files
gulp.task( 'compile', ['css'] );
