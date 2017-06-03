<?php
include "config/config_include.php";

//get the good controller
$controllername = $configReader->getControllerName();
if( class_exists($controllername) )
{
	$FC = new $controllername( $smarty, $yourSettingsTxt );
}
//if any error, we call the frontController with an error msg
else
{
	$FC = new FrontController( $smarty, $yourSettingsTxt );
	echo 'The `myLocalUse` in your config.json is incorrect';
}
$FC->catchGlobData();
$FC->displayTpl( $templateList, $repoScan, $allowParentLink );
?>
