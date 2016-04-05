var gulp =		require("gulp");
var concat =		require("gulp-concat");
var plumber =		require("gulp-plumber");
var uglify =		require("gulp-uglify");
var rename =		require("gulp-rename");
var compass =		require('gulp-compass');


var jsPath = "./js";
var cssPath = "./css";
var scssPath = "./scss";


gulp.task('default', ['script-concat', 'watch']);

gulp.task('script-concat', function(){

	// var files = [
	// 	jsWpPath+'/wp-embed.min.js',
	// 	jsPath+'/aleteia.js',
	// 	jsPath+'/functions.js',
	// 	jsPath+'/softloading.js',
	// 	jsPath+'/googl-analitycs.js',
	// 	jsPath+'/bootstrap-scrollspy.js',
	// 	jsPath+'/aleteiaDesktop.js'
	// ];
	// gulp.src(files)
	// 	.pipe(plumber())
	// 	.pipe(concat('aleteia-desktop.min.js'))
	// 	.pipe(uglify())
	// 	.pipe(gulp.dest(jsPath));

	// files = [
	// 	jsWpPath+'/wp-embed.min.js',
	// 	jsPath+'/aleteia.js',
	// 	jsPath+'/functions.js',
	// 	jsPath+'/softloading.js',
	// 	jsPath+'/aleteia-mobile.js',
	// 	jsPath+'/jquery-smoothscroll.js'
	// ];
	// gulp.src(files)
	// 	.pipe(plumber())
	// 	.pipe(concat('aleteia-mobile.min.js'))
	// 	.pipe(uglify())
	// 	.pipe(gulp.dest(jsPath));
});

gulp.task('compass', function() {
	gulp.src(cssPath + '/*.scss')
		.pipe(compass({
			config_file: './config.rb',
			css: cssPath,
			sass: scssPath
		}))
		.pipe(gulp.dest('app/assets/temp'));
});

gulp.task('watch', function(){
	gulp.watch(jsPath+"/**/*.js", ['script-concat']);
});