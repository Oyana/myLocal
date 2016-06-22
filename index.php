<?php
include "config/config_include.php";

//get the good controller
$controllername = $configReader->getControllerName();
if( class_exists($controllername) )
{
	$FC = new $controllername( $smarty );
}
//if any error, we call the frontController with an error msg
else
{
	$FC = new FrontController( $smarty );
	echo 'The `myLocalUse` in your config.json is incorrect';
}
$FC->catchGlobData();
$FC->displayTpl( $templateList );
?>
