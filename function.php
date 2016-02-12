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
		<link rel="icon" type="image/x-icon" href="./myLocal/img/favicon.ico" />
	</head>
	<body>
		<div id="main">
EOF;
echo '<input type="hidden" id="myLocalSha" value="'.getComitKey("myLocal").'" />';
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
		<li><a href="./#conff">conffig myLocal</a></li>
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
	<div id="conffZone">	
	</div>
	</body>
	<script src="./myLocal/js/jquery_2_1_4.js" type="text/javascript" charset="utf-8"></script>
	<script src="./myLocal/js/jquery.mmenu.min.all.js" type="text/javascript" charset="utf-8"></script>
	<script src="./myLocal/js/scripts.js" type="text/javascript" charset="utf-8"></script>
</html>
EOF;
}

function getComitKey($checkFolder)
{
	// TODO FETCH HEAD PARSING
	$confFile = $checkFolder."/.git/FETCH_HEAD";
	if (file_exists($confFile))
	{
		$fp = fopen($confFile, 'r');
		$data = fread($fp, 4096);
		$key = split("	",$data)[0];
		return $key;
	}
	else
	{
		return 0;
	}
}
function displayList()
{
	echo '<ul class="site-l">';
	$files = scandir("./");
	$realpath = str_replace(array('/', '\\'),'',split( ":",realpath('.') )[1]);
	foreach ($files as $key => $value) 
	{
		if (
				isset($value)
			&&	$value !="."
			&&	$value !=".."
			&&	!is_file($value)
			&&	$value !="myLocal"
			&&	$value !="xampp"
			&&	$value !="wampp"
			&&	$value !="lampp"
			&&	$value !="mampp"
			&&	$value !="webalizer"
			&&	$value !="img"
			&&	$value !="js"
			&&	$value !="image"
			&&	$value !="cache"
			&&	( $realpath !='xampphtdocs' || $value != 'dashboard' )
			&&	( $realpath !='xampphtdocs' || $value != 'forbidden' )
			&&	( $realpath !='xampphtdocs' || $value != 'forbidden' )
			&&	( $realpath !='xampphtdocs' || $value != 'restricted' )
			&&	( $realpath !='xampphtdocs' || $value != 'xampp' )
			)
		{
			$img = "";
			$folder = array('myLocal/screen', $value."/img", $value);
			$name = array($value, "screen", "screenshot", "logo", "maquette");
			$ext = array("png", "jpg", "svg", "gif");
			$baseUrl = "";
			$identifier = "";
			$link = "";
			$linkType = "";
			$xmlfile = $value."/.git/sourcetreeconfig";
			$confFile = $value."/.git/config";

			foreach ($folder as $k1 => $fileFold) 
			{
				foreach ($name as $k2 => $fileName)
				{
					foreach ($ext as $k3 => $fileExt)
					{
						if (file_exists('myLocal/screen/'.$value.'.'.$fileExt)) {
							$img = 'myLocal/screen/'.$value.'.'.$fileExt;
							break;
						}
						elseif (file_exists($fileFold.'/'.$fileName.'.'.$fileExt)) {
							$img = $fileFold.'/'.$fileName.'.'.$fileExt;
							break;
						}
					}
				}
			}
			
			if (file_exists($xmlfile)) {
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
						$identifier = $conff["value"];//empty identifier if clone by url
					}
				}
			}
			// could cause error login if clone by url
			if(file_exists($confFile) && empty($identifier) )
			{
				$fp = fopen($confFile, 'r');
				$data = fread($fp, 4096);
				$conffGitSplit = array();
				$data = str_replace(array(' ','&lt;br/&gt;','&quot;', '	', '\nl', '\r', '\rn', '\r\n', '\n\r','"', ']','['), '', $data);
				$data = nl2br($data);
				$data = split('\nl', $data);
				$conff = "";
				foreach ($data as $key => $val) {
					$conff .= $val;
				}
				$conffGit = split('<br />', $conff);
				foreach ($conffGit as $key => $v)
				{
					$v = split('=',$v);
				
					if ( !empty($v[0]) && !empty($v[1]) )
					{
						$v[0] = preg_replace("/[^A-Za-z0-9 ]/", '',$v[0]);
						$conffGitSplit[$v[0]] = $v[1];
					}
				}
				if (!empty($conffGitSplit["url"]))
				{
					$link = $conffGitSplit["url"];
					if ( isset( split( "github", $link )[1] ) )
					{
						$linkType = "github";
					}
					elseif ( isset( split( "bitbucket", $link )[1] ) ) {
						$linkType = "bitbucket";
					}
					else
					{
						$linkType = "git";
					}
				}
			}
			echo "<li class='site'>";
				echo "<input class='comitKey' type='hidden' value='" . getComitKey($value) . "' />";
				echo "<div class='site-content' >";
					echo "<div class='rotation-axe axe'>";
						echo "<div class='radius-axe axe'>";
							echo "<div class='bck-axe axe' style='background-image:url(".$img.")'>";
								if ( !empty($baseUrl) && !empty($identifier) )
								{
									echo "<a class='git-link' target='_blank' href='".$baseUrl."/".$identifier."' title='".$value." bitbucket'><img src='./myLocal/img/bitbucket_logo.png' alt='logo bitbucket'/></a>";
								}
								elseif( !empty($link) && !empty($linkType) )
								{
									echo "<a class='git-link' target='_blank' href='".$link."' title='".$value." ".$linkType."'><img src='./myLocal/img/".$linkType."_logo.png' alt='logo ".$linkType."'/></a>";
								}
								echo "<a class='local-link' href='".$value."' title='".$value." local'>".$value."</a>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</li>";
		}
	}
	echo '</ul>';
}

function displayConfForm(){
	echo <<<EOF
	<h1> Conff Your Local </h1>
	<a href="#closeConff" class="btn-close btn" >x</a>
EOF;
}
?>