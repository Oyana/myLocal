<?php
function ddd( $value = false )
{
	die( nl2br( print_r( $value, true ) ) );
}
require_once("defines.php");
require_once('ConfigReader.php');
//init config reader
$configReader = new ConfigReader($mainFolderName , $templateName);
$userConfigs = $configReader->getConfig();
$yourSettingsTxt = "";
//so beautifull code <3
if ( $userConfigs )
{
	foreach( $userConfigs as $configName => $userConfig )
	{
		if( isset( $$configName ) )
		{
			$$configName = $configReader->getConfig($configName);
			$yourSettingsTxt .= $configName . " :  " . $$configName . "<br />";
		}
	}
}
if ( $devMod )
{
	error_reporting(E_ALL);
	ini_set('display_errors',true);
}
require_once("config_smarty.php");
require_once(CLASS_DIR . "/Controller.php");
require_once(CLASS_DIR . "/FrontController.php");
$ControllerName = $configReader->getControllerName();
$reqError = 1;
if( file_exists( CLASS_DIR . "/" . $ControllerName . ".php" ) )
{
	require_once( CLASS_DIR . "/" . $ControllerName . ".php" );
	$reqError = 0;
}
if( file_exists( CLASS_OVERRIDE . "/" . $ControllerName . ".php" ) )
{
	require_once( CLASS_OVERRIDE . "/" . $ControllerName . ".php" );
	$reqError = 0;
}
?>
