// var gulp =		require("gulp");
// // var concat =		require("gulp-concat");
// // var plumber =		require("gulp-plumber");
// // var uglify =		require("gulp-uglify");
// // var rename =		require("gulp-rename");
// // var compass =		require('gulp-compass');
// var sass = require('gulp-sass');

// var jsPath = "./js";
// var cssPath = "./css";
// var scssPath = "./scss";


// gulp.task('default', ['script-concat', 'watch']);

// gulp.task('script-concat', function(){
// 	var files = [
// 		jsPath+'/jquery_3_2_1.js',
// 		jsPath+'/*.js',
// 		'!'+jsPath+'/main.min.js'
// 	];
// 	gulp.src(files)
// 		.pipe(plumber())
// 		.pipe(concat('main.min.js'))
// 		.pipe(uglify())
// 		.pipe(gulp.dest(jsPath));
// });

// gulp.task('compass', function() {
// 	gulp.src(cssPath + '/*.scss')
// 		.pipe(compass({
// 			config_file: './config.rb',
// 			css: cssPath,
// 			sass: scssPath
// 		}))
// 		.pipe(gulp.dest('app/assets/temp'));
// });

// gulp.task('sass', function () {
//   gulp.src(scssPath + 'myLocal.scss')
// 	.pipe(sass({
// 	  // includePaths: require('node-bourbon').with('other/path', 'another/path')
// 	  // - or -
// 	  includePaths: require('node-bourbon').includePaths
// 	}))
// 	.pipe(gulp.dest(cssPath + 'myLocal.css'));
// });

// gulp.task('watch', function(){
// 	gulp.watch(scssPath+"/**/*.scss", ['compass']);
// 	gulp.watch([jsPath+"/**/*.js", "!"+jsPath+"/**/*min.js"], ['script-concat']);
// });
// 
'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
  return gulp.src('./templates/classic2017/scss/**/*.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(gulp.dest('./css'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./templates/classic2017/scss/**/*.scss', ['sass']);
});