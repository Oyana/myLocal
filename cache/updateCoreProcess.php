<?php
if ( empty($_GET["release"]) )
{
	header("Location: http://127.0.0.1/" );
}

if ( empty($_GET["is_cached"]) || !$_GET["is_cached"] )
{
	if ( !copy( __FILE__, "../cache/updateCoreProcess.php" ) )
	{
		throw new Exception("Error Processing in copy Request", 1);
	}
	header("Location: ../cache/updateCoreProcess.php?release=" . $_GET["release"] . "&is_cached=1");
}
echo "string";
die();
$format = ( empty($_GET["format"]) ) ? ".zip" : $_GET["format"] ;
$source = "https://github.com/Golgarud/myLocal/archive/" . $_GET["release"] . $format;
$destination = "../cache/myLocalTmp-" . $_GET["release"] . $format;
file_put_contents($destination, fopen($source, 'r'));

?>