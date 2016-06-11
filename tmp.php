<?php
function rrmdir($dir)
{
	if (is_dir($dir))
	{
	$objects = scandir($dir);
	foreach ($objects as $object)
	{
		if ($object != "." && $object != "..") {
			if (filetype($dir."/".$object) == "dir") 
			{
				rrmdir($dir."/".$object);
			}
			else 
			{
				unlink ($dir."/".$object);
			}
		}
	}
	reset($objects);
	rmdir($dir);
	}
}
 function rcopy($src, $dst) 
 {
	if (file_exists ( $dst ))
	{
		rrmdir ( $dst );
	}
	if (is_dir ( $src )) 
	{
		mkdir ( $dst );
		$files = scandir ( $src );
		foreach ( $files as $file )
		{
			if ($file != "." && $file != "..")
			{
				rcopy ( "$src/$file", "$dst/$file" );
			}
		}
	}
	else if (file_exists ( $src ))
	{
		copy ( $src, $dst );
	}
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
$destination = "../cache/myLocalTmp-" . $_GET["release"] . $format;
if ( !file_put_contents($destination, fopen($source, 'r')) )
{
	throw new Exception("Error Processing in download Request", 1);
}

// content delete list
$fileList = array(
	"../*",
	"../cache/.sass-cache/*",
	"../cache/.smaty-cache/*",
	"../cache/.smaty-compile/*",
	"../templastes/*"
);

foreach ($fileList as $key => $fileName)
{
	$files = glob( $fileName );
	foreach($files as $file)
	{ 
		if(is_file($file))
		{
			unlink($file);
		}
	}
}

$zip = new ZipArchive;
$res = $zip->open( $destination );
if ($res === TRUE)
{
	$zip->extractTo('./');
	$zip->close();
	echo 'woot!';
}
else
{
	echo 'doh!';
}

// file to update
$baseName = "myLocal-" . $_GET["release"];
$fileList = array(
	"/config",
	"/Class",
	"/tools",
	"/templates/night2015",
	"/templates/night2016",
	"/templates/day2015",
	"/templates/day2016",
	"/index.php",
	"/include.php",
	"/readme.md",
	"/license.md"
);

foreach ($fileList as $key => $file)
{
	rcopy( $baseName . $file, ".." . $file );
}

rrmdir($baseName);
rrmdir("myLocalTmp-" . $_GET["release"] . $format);
// TODO
// Affichage
// rcopy( "myLocalTmp-" . $_GET["release"], "../" );
?>