<?php
die("test auto updater (Not ready yet)");
error_reporting(E_ALL);
function recurse_delete( $dirPath )
{
	if ( !is_dir( $dirPath ) )
	{
		if ( is_file($dirPath) )
		{
			unlink( $dirPath );
			return true;
		}
		else
		{
			return false;
		}
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		$dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ( $files as $file )
	{
		if ( is_dir($file) )
		{
			recurse_delete($file);
		}
		else
		{
			unlink($file);
		}
	}
	rmdir($dirPath);
	return true;
}

function recurse_copy( $src, $dst )
{ 
	if ( is_dir($src) )
	{
		$dir = opendir($src); 
		mkdir($dst);
		while(false !== ( $file = readdir($dir)) )
		{ 
			if (( $file != '.' ) && ( $file != '..' ))
			{ 
				if ( is_dir($src . '/' . $file) )
				{ 
					recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else
				{ 
					copy($src . '/' . $file, $dst . '/' . $file); 
				} 
			}
		} 
		closedir($dir); 
		return true;
	}
	elseif ( is_file($src) )
	{
		copy($src, $dst);
		return true; 
	}
	return false;
}

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

$format = ( empty($_GET["format"]) ) ? ".zip" : $_GET["format"] ;
$source = "https://github.com/Golgarud/myLocal/archive/" . $_GET["release"] . $format;
$destination = "./myLocalTmp-" . $_GET["release"] . $format;
$tempExtract = "./myLocal-" . $_GET["release"] . "/";
file_put_contents($destination, fopen($source, 'r'));

$zip = new ZipArchive;
$res = $zip->open( $destination );
if ($res === TRUE)
{
	$zip->extractTo( "./" );
	$zip->close();
	$needUpdate = array(
			"config/",
			"Class/",
			"tools/",
			"templates/night2015/",
			"templates/night2016/",
			"templates/day2015/",
			"templates/day2016/",
			"index.php",
			"include.php",
			"readme.md",
			"license.md"
	);

	foreach ($needUpdate as $key => $value)
	{
		if ( file_exists( "../" . $value ) )
		{
			recurse_delete( "../" . $value );
		}
		recurse_copy( $tempExtract . $value, "../" . $value );
	}

	if ( file_exists( $tempExtract ) )
	{
		recurse_delete( $tempExtract );
	}
	if ( file_exists( $destination ) )
	{
		unlink( $destination );
	}
}
header("Location: ..?newVersion=" . $_GET["release"]);
?>