<?php
	include "config/config_include.php";
	include "function.php";

	$FC = new FrontController( $smarty );
	$FC->displayTpl( $templateList );
	// if (empty($_POST["method"]))
	// {
	// 	displayHead();
	// 	displayHeader();
	// 	displayList();
	// 	displayFooter();
	// 	displayFoot();
	// }
	// else
	// {
	// 	switch ($_POST["method"])
	// 	{
	// 		case 'getConfForm':
	// 			displayConfForm();
	// 			break;
	// 		default:
	// 			echo "Error: undefined method!";
	// 			die();
	// 			break;
	// 	}
	// }
?>