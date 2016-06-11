<?php
	include "config/config_include.php";

	$FC = new FrontController( $smarty );
	$FC->catchGlobData();
	$FC->displayTpl( $templateList );
?>