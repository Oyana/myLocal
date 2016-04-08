<?php
if (isset($_SERVER['HTTP_COOKIE']))
{
	foreach($cookies as $cookie)
	{
	   	$parts = explode('=', $cookie);
		$name = trim($parts[0]);
		setcookie($name, '', time()-1000);
		setcookie($name, '', time()-1000, '/');
	}
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>