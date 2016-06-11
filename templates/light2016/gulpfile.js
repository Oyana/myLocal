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

	var files = [
		jsPath+'/jquery_2_1_4.js',
		jsPath+'/*.js',
		'!'+jsPath+'/main.min.js'
	];
	gulp.src(files)
		.pipe(plumber())
		.pipe(concat('main.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(jsPath));
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
	gulp.watch(scssPath+"/**/*.scss", ['compass']);
	gulp.watch([jsPath+"/**/*.js", "!"+jsPath+"/**/*min.js"], ['script-concat']);
});
