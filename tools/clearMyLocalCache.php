<?php
chdir( ".." );
include "config/config_include.php";

foreach ( $templateList as $key => $value )
{
	$smarty->clearCache( $value . ".tpl" );
}
$smarty->clearCache( "config.tpl" );
header( "location:.." );
?>