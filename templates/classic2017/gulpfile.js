var gulp =			require('gulp');
var sass =			require('gulp-sass');
var concat =		require("gulp-concat");
var plumber =		require("gulp-plumber");
var uglify =		require("gulp-uglify");
var autoprefixer =	require('gulp-autoprefixer');

var jsPath = "./js";
var cssPath = "./css";
var scssPath = "./scss";

gulp.task('default', ['script-concat', 'watch']);

gulp.task('script-concat', function(){
	var files = [
		jsPath+'/jquery_3_2_1.js',
		jsPath+'/*.js',
		'!'+jsPath+'/main.min.js'
	];
	gulp.src(files)
		.pipe(plumber())
		.pipe(concat('main.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(jsPath));
});

gulp.task('sass', function () {
	return gulp.src(scssPath + '/**/*.scss')
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: require('node-bourbon').includePaths
		}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest(cssPath));
});

gulp.task('watch', function(){
	gulp.watch(scssPath+"/**/*.scss", ['sass']);
	gulp.watch([jsPath+"/**/*.js", "!"+jsPath+"/**/*min.js"], ['script-concat']);
});
