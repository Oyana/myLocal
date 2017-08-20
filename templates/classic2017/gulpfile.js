var oyana = require('gulp-oyana');
var options = {
	"jsMinPath" : "./jsMin",
	"jsPath" : "./js",
	"cssPath" : "./css",
	"scssPath" : "./scss",
	"proxyPath" : "127.0.0.1",
	"outputStyle" : "compressed"
}
oyana( options );