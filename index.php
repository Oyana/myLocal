<?php
	include "function.php";
	if (empty($_POST["method"]))
	{
		displayHead();
		displayHeader();
		displayList();
		displayFooter();
		displayFoot();
	}
	else
	{
		switch ($_POST["method"])
		{
			case 'getConfForm':
				displayConfForm();
				break;
			default:
				echo "Error: undefined method!";
				die();
				break;
		}
	}
?>