<?php
function displayHead()
{
	echo <<<EOF
	<!DOCTYPE html>
	<html>
	<head>
		<title>localHost | homeSweetHome...</title>
		<link rel="stylesheet" type="text/css" href="./myLocal/css/reset.css">
		<link rel="stylesheet" type="text/css" href="./myLocal/css/jquery.mmenu.all.css">
		<link rel="stylesheet" type="text/css" href="./myLocal/css/styles.css">
		<link rel="stylesheet" type="text/css" href="./myLocal/css/media.css">
	</head>
	<body>
		<div id="main">
EOF;
}

function displayHeader()
{
	echo '<a id="btnMenu" href="#menu"><img src="./myLocal/img/menu.png" alt="menu"/></a>';
}

function displayMM()
{
echo <<<EOF
	<nav id="menu">
	<ul>
		<li><a href="../xampp/">XAMPP</a>
			<ul>
				<li><a href="../xampp/status.php">Statuts</a></li>
				<li><a href="../security/index.php">Securité</a></li>
				<li><a href="../xampp/manuals.php">Manuel</a></li>
			</ul>
		</li>
		<li><a href="../xampp/components.php">Infos</a>
			<ul>
				<li><a href="../xampp/phpinfo.php">PHP</a></li>
				<li><a href="../xampp/perlinfo.pl">Perl</a></li>
				<li><a href="../xampp/java.php">J2ee</a></li>
			</ul>
		</li>
		<li><a href="../phpmyadmin/">PhpMyAdmin</a></li>
		<li><a href="../webalizer/">webAlizer</a></li>
		<li><a href="../xampp/mailform.php/">mailForm</a></li>
	</ul>
	</nav>
EOF;
}

function displayFooter()
{
	echo "</div><!-- #main -->";
	displayMM();
}

function displayFoot()
{
echo <<<EOF
	</body>
	<script src="./myLocal/js/jquery_2_1_4.js" type="text/javascript" charset="utf-8"></script>
	<script src="./myLocal/js/jquery.mmenu.min.all.js" type="text/javascript" charset="utf-8"></script>
	<script src="./myLocal/js/scripts.js" type="text/javascript" charset="utf-8"></script>
</html>
EOF;
}
function displayList()
{
	echo '<ul class="site-l">';
	$files = scandir("./");

	foreach ($files as $key => $value) 
	{
		if (
				isset($value)
			&&	$value !=".."
			&&	$value !="."
			&&	$value !="index.php"
			&&	$value !="myLocal"
			)
		{
			$img = "";
			$folder = array('myLocal/screen', $value."/img", $value);
			$name = array($value, "screen", "screenshot", "logo", "maquette");
			$ext = array("png", "jpg", "svg", "gif");
			foreach ($folder as $k1 => $fileFold) 
			{
				foreach ($name as $k2 => $fileName)
				{
					foreach ($ext as $k3 => $fileExt)
					{
						if (file_exists($fileFold.'/'.$fileName.'.'.$fileExt)) {
							$img = $fileFold.'/'.$fileName.'.'.$fileExt;
							break;
						}
					}
				}
			}
			if (file_exists($value."/.git/sourcetreeconfig")) {
				$xmlfile = $value."/.git/sourcetreeconfig";
				$baseUrl = "";
				$identifier = "";
				$xmlparser = xml_parser_create();
				$fp = fopen($xmlfile, 'r');
				$xmldata = fread($fp, 4096);
				xml_parse_into_struct($xmlparser,$xmldata,$values);
				xml_parser_free($xmlparser);
				$conffBitBucket = $values;
				foreach ($conffBitBucket as $key => $conff) {
					if ($conff["tag"] == "BASEURL")
					{
						$baseUrl = $conff["value"];
					}
					elseif($conff["tag"] == "IDENTIFIER")
					{
						$identifier = $conff["value"];
					}
				}
			}
			echo "<li class='site'>";
				echo "<div class='site-content' style='background-image:url(".$img.")''>";
					if ( !empty($baseUrl) && !empty($identifier) )
					{
						echo "<a class='bitbucket-link' target='_blank' href='".$baseUrl."/".$identifier."' title='".$value." bitbucket'><img src='./myLocal/img/bitbucket_logo.png' alt='logo bitbucket'/></a>";
					}
					echo "<a class='local-link' href='".$value."' title='".$value." local'>".$value."</a>";
				echo "</div>";
			echo "</li>";
		}
	}
	echo '</ul>';
}
?>