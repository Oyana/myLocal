<?php
require_once(SMARTY_DIR . '/Smarty.class.php');

function minify_html($tpl_output, Smarty_Internal_Template $template)
{
	$tpl_output = preg_replace('![\t ]*[\r\n]+[\t ]*!', '', $tpl_output);
	return $tpl_output;
}

$smarty = new Smarty();
$smarty->setPluginsDir(SMARTY_PLUGIN);
$smarty->cache_dir = CACHE_SMARTY_DIR;
$smarty->template_dir = TEMPLATE_DIR;
$smarty->compile_dir = CACHE_SMARTY_COMPILE;
$smarty->config_dir = CONFIG_DIR;

$smarty->caching = $cachesFilesMod;
$smarty->compile_check = $checkCompilation;

if ( $compressedFilesMod )
{
	$smarty->registerFilter("output", "minify_html");
}
$configRoot = array(
	"root_local"			=>	ROOT_LOCAL,
	"root_url"			=>	ROOT_URL,
	"root"				=>	ROOT_DIR,
	"config"			=>	CONFIG_DIR,
	"class"				=>	CLASS_DIR,
	"smarty"			=>	SMARTY_DIR,
	"smarty_sysplugins"		=>	SMARTY_SYSPLUGINS_DIR,
	"smary_plugin"		=>	SMARTY_PLUGIN,
	"cache"			=>	CACHE_DIR,
	"cache_smarty"		=>	CACHE_SMARTY_DIR,
	"cache_smarty_c"		=>	CACHE_SMARTY_COMPILE,
	"template"			=>	TEMPLATE_DIR,
	"img"				=>	IMG_DIR,
	"js"				=>	JS_DIR,
	"css"				=>	CSS_DIR,
	"shoot"			=>	SHOOT_DIR
);

$configUrl = array(
	"root_local"			=>	ROOT_LOCAL,
	"root_url"			=>	ROOT_URL,
	"root"				=>	ROOT_URL,
	"config"			=>	URL_DOM . CONFIG_DIR,
	"class"				=>	URL_DOM . CLASS_DIR,
	"smarty"			=>	URL_DOM . SMARTY_DIR,
	"smarty_sysplugins"		=>	URL_DOM . SMARTY_SYSPLUGINS_DIR,
	"smary_plugin"		=>	URL_DOM . SMARTY_PLUGIN,
	"cache"			=>	URL_DOM . CACHE_DIR,
	"cache_smarty"		=>	URL_DOM . CACHE_SMARTY_DIR,
	"cache_smarty_c"		=>	URL_DOM . CACHE_SMARTY_COMPILE,
	"template"			=>	URL_DOM . TEMPLATE_DIR,
	"img"				=>	URL_DOM . IMG_DIR,
	"js"				=>	URL_DOM . JS_DIR,
	"css"				=>	URL_DOM . CSS_DIR,
	"shoot"			=>	URL_DOM . SHOOT_DIR
);

$configMod = array(
	"dev"				=>	$devMod,
	"allowUpdate"		=>	$updateScan,
	"allowGitScan"		=>	$repoScan,
	"release"			=>	$myLocalRelease,
	"compressed_files"		=>	$compressedFilesMod,
	"path"				=>	ROOT_URL
);
$smarty->assign("url", $configUrl);
$smarty->assign("dir", $configRoot);
$smarty->assign("mod", $configMod);
?>
