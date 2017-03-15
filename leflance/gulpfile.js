'use strict';

var gulp = require('gulp'),
    watch = require('gulp-watch'),
    prefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    sourcemaps = require('gulp-sourcemaps'),
    cssclean = require('gulp-clean-css'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    rigger = require('gulp-rigger'),
    rimraf = require('rimraf'),
    browserSync = require('browser-sync').create();

var path = {
    build: {
        html: 'resources/origin-source/build/',
        js: 'resources/origin-source/build/assets/js/',
        css: 'resources/origin-source/build/assets/css/',
        img: 'resources/origin-source/build/assets/images/',
        fonts: 'resources/origin-source/build/assets/fonts/'
    },
    buildPublic: {
        js: 'public/assets/js/',
        css: 'public/assets/css/',
        img: 'public/assets/images/',
        fonts: 'public/assets/fonts/'
    },
    source: {
        html: 'resources/origin-source/source/*.html',
        js: 'resources/origin-source/source/assets/js/*.js',
        jsLibs: 'resources/origin-source/source/assets/js/libs.js',
        style: 'resources/origin-source/source/assets/css/*.css',
        img: 'resources/origin-source/source/assets/images/**/*.*',
        fonts: 'resources/origin-source/source/assets/fonts/**/*.*'
    },
    watch: { 
        html: 'resources/origin-source/source/**/*.html',
        js: 'resources/origin-source/source/assets/js/**/*.js',
        style: 'resources/origin-source/source/assets/css/**/*.css',
        img: 'resources/origin-source/source/assets/images/**/*.*',
        fonts: 'resources/origin-source/source/assets/fonts/**/*.*'
    },
    clean: './resources/origin-source/build'
};

gulp.task('html:build', function () {
    gulp.src(path.source.html)
        .pipe(rigger()) 
        .pipe(gulp.dest(path.build.html)); 
});

gulp.task('js:buildLibs', function () {
    gulp.src(path.source.jsLibs)
        .pipe(rigger()) 
        .pipe(uglify())
        .pipe(gulp.dest(path.build.js))
        .pipe(gulp.dest(path.buildPublic.js));

});
gulp.task('js:build', function () {
    gulp.src(path.source.js)
        .pipe(rigger())
        .pipe(gulp.dest(path.build.js))
        .pipe(gulp.dest(path.buildPublic.js));

});

gulp.task('style:build', function () {
    gulp.src(path.source.style)
        .pipe(cssclean())
        .pipe(prefixer())
        .pipe(gulp.dest(path.build.css))
        .pipe(gulp.dest(path.buildPublic.css));

});

gulp.task('image:build', function () {
    gulp.src(path.source.img)
        .pipe(imagemin({ 
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()],
            interlaced: true
        }))
        .pipe(gulp.dest(path.build.img))
        .pipe(gulp.dest(path.buildPublic.img));

});

gulp.task('fonts:build', function() {
    gulp.src(path.source.fonts)
        .pipe(gulp.dest(path.build.fonts))
        .pipe(gulp.dest(path.buildPublic.fonts))
});

gulp.task('build', [
    'html:build',
    'js:buildLibs',
    'js:build',
    'style:build',
    'fonts:build',
    'image:build'
]);

gulp.task('watch', function(){
    watch([path.watch.html], function(event, cb) {
        gulp.start('html:build');
        setTimeout(browserSync.reload, 500);
    });
    watch([path.watch.style], function(event, cb) {
        gulp.start('style:build');
        setTimeout(browserSync.reload, 500);
    });
    watch([path.watch.js], function(event, cb) {
        gulp.start('js:buildLibs');
        setTimeout(browserSync.reload, 500);
    });
    watch([path.watch.js], function(event, cb) {
        gulp.start('js:build');
        setTimeout(browserSync.reload, 500);
    });
    watch([path.watch.img], function(event, cb) {
        gulp.start('image:build');
        setTimeout(browserSync.reload, 500);
    });
    watch([path.watch.fonts], function(event, cb) {
        gulp.start('fonts:build');
        setTimeout(browserSync.reload, 500);
    });
});

gulp.task('clean', function (cb) {
    rimraf(path.clean, cb);
});

gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: "resources/origin-source/build/"
        }
    });
});

gulp.task('source', ['build', 'browser-sync', 'watch']);

//const elixir = require('laravel-elixir');
//
//elixir(function (mix) {
//    mix.webpack(
//        './resources/assets/js/ws-app/ws-server.js',
//        './public/js/ws-public-app/bundle.js'
//    );
//});
