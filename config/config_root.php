<?php
// config
function rp( $path )
{
	$out = array();
	foreach(explode('/', $path) as $i=>$fold)
	{
		if ( $fold == '' || $fold == '.')
		{
			continue;
		}
		elseif ($fold == '..' && $i > 0 && end($out) != '..') 
		{
			array_pop($out);
		}
		else
		{
			$out[]= $fold;
		}
	}
	return ($path{0}=='/'?'/':'').join('/', $out);
}
$root = explode( basename($_SERVER['PHP_SELF']), $_SERVER["PHP_SELF"] );

$InFold = explode( MAIN_FOLDER_NAME, $root[0] );
// check path

if ( defined("MAIN_FOLDER_NAME") )
{
	if ( isset($InFold[1]) )
	{
		chdir("..");
	}
	define("ROOT_DIR", MAIN_FOLDER_NAME);
	define("ROOT_LOCAL", "http://" . $_SERVER['HTTP_HOST'] . "/" );
	define("ROOT_URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . ROOT_DIR);
}
else{
	define("ROOT_DIR",$root[0]);
	define("ROOT_URL", "http://" . $_SERVER['HTTP_HOST'] . ROOT_DIR);
}
define("URL_DOM", "http://" . $_SERVER['HTTP_HOST'] . "/" );

define("CONFIG_DIR", rp(ROOT_DIR . "/config") );
define("SHOOT_DIR", rp(ROOT_DIR . "/screen") );

// class
define("CLASS_DIR", rp( ROOT_DIR . "/Class" ) );
define("SMARTY_DIR", CLASS_DIR . "/Smarty");
define("SMARTY_SYSPLUGINS_DIR", SMARTY_DIR . "/sysplugins/");//END slashess used in smarty class
define("SMARTY_PLUGIN", SMARTY_DIR . "/plugins/");//END slashess used in smarty class

// cache
define("CACHE_DIR", rp( ROOT_DIR . "/cache" ) );
define("CACHE_SMARTY_DIR", CACHE_DIR . "/.smarty-cache");
define("CACHE_SMARTY_COMPILE", CACHE_DIR . "/.smarty-compile");

// Templates
define("TEMPLATE_EXT", rp(".tpl") );
define("TEMPLATE_DIR", rp( ROOT_DIR . "/templates/" . TEMPLATE_NAME) );
define("IMG_DIR", TEMPLATE_DIR . "/img");
define("JS_DIR", TEMPLATE_DIR . "/js");
define("CSS_DIR", TEMPLATE_DIR . "/css");
?>
