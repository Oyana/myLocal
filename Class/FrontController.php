<?php
/**
 * FrontController
 *
 * @package GuildPanel
 * @subpackage class
 */
class FrontController extends Controller
{
	private $templateList;
	
	/**
	 * __construct moduleController
	 * @author Golga
	 * @since 0.2
	 * @return boolean
	 */
	public function __construct( $smarty )
	{
		parent::__construct( $smarty );
	}

	/**
	 * __destruct
	 *
	 * @author Golga
	 * @since 0.2
	 * @param none
	 * @return boolean
	*/
	public function __destruct()
	{
		parent::__destruct();
		unset($this->templateList);
		return true; 
	}

	/**
	 * catchGlobData
	 * @author Golga
	 * @since 0.2
	 * @param array		$templateList
	 * @param array		$hookData
	 * @return boolean
	 */
	public function catchGlobData( $debug = false )
	{
		$glob = array( 
			'get'		=> $_GET,
			'post'		=> $_POST,
			'selfUrl'	=> "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
			'prevUrl'	=> ( isset($_SERVER["HTTP_REFERER"]) ) ? $_SERVER["HTTP_REFERER"] : null ,
			'host'		=> ( isset($_SERVER["HTTP_HOST"]) ) ? $_SERVER["HTTP_HOST"] : null ,
			'request'	=> ( isset($_SERVER["REQUEST_URI"]) ) ? $_SERVER["REQUEST_URI"] : null ,
			'templateList'	=> $this->templateList
		);

		if ( $debug )
		{
			throw new Exception( "Display debuging informations: \n<br />" . print_r( $this->hookData ,1 ) . "\n<hr />" . print_r( $glob, 1 ) );
		}
		else
		{
			$this->smartyAssign( $glob );
		}
	}

	/**
	 * displayTpl
	 * @author Golga
	 * @since 0.2
	 * @param array
	 * @return boolean
	 */
	public function displayTpl( $templateList )
	{
		$this->templateList = $templateList;
		if (empty($_POST["method"]))
		{
			$this->getList();
			$this->smartyDisplay($templateList);
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
	}

	/**
	 * displayTpl
	 * @author Golga
	 * @since 0.2
	 * @return void
	 */
	public function getList()
	{
		$files = scandir("./");
		$realpath = str_replace(array('/', '\\'),'',explode( ":",realpath('.') )[1]);
		$siteList = array();
		foreach ($files as $key => $value) 
		{
			if (
					isset( $value )
				&&	$value != "."
				&&	$value != ".."
				&&	!is_file( $value )
				&&	$value != "myLocal"
				&&	$value != "xampp"
				&&	$value != "wampp"
				&&	$value != "dashboard"
				&&	$value != "lampp"
				&&	$value != "mampp"
				&&	$value != "webalizer"
				&&	$value != "img"
				&&	$value != "js"
				&&	$value != "image"
				&&	$value != "cache"
				&&	( $realpath != "xampphtdocs" || $value != "dashboard" )
				&&	( $realpath != "xampphtdocs" || $value != "forbidden" )
				&&	( $realpath != "xampphtdocs" || $value != "restricted" )
				&&	( $realpath != "xampphtdocs" || $value != "xampp" )
				)
			{
				$siteList[$key]["name"] = $value;
				// reset var
				$siteList[$key]["img"] = "";
				$siteList[$key]["baseUrl"] = "";
				$siteList[$key]["identifier"] = "";
				$siteList[$key]["link"] = "";
				$siteList[$key]["linkType"] = "";
				$siteList[$key]["commitKey"] = "";

				$xmlfile = $value."/.git/sourcetreeconfig";
				$confFile = $value."/.git/config";
				$confSvn = $value."/.svn/";
				
				$siteList[$key]["img"] = $this->getBck( $siteList[$key]["name"] );
				$siteList[$key]["commitKey"] = $this->getComitKey( $siteList[$key]["name"] );
				if ( file_exists($xmlfile) )
				{
					$xmlparser = xml_parser_create();
					$fp = fopen($xmlfile, 'r');
					$xmldata = fread($fp, 4096);
					xml_parse_into_struct($xmlparser,$xmldata,$values);
					xml_parser_free($xmlparser);
					$conffBitBucket = $values;
					foreach ($conffBitBucket as $k => $conff)
					{
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
				if( file_exists($confFile) && empty($identifier) )
				{
					$fp = fopen($confFile, 'r');
					$data = fread($fp, 4096);
					$conffGitSplit = array();
					$data = str_replace(array(' ','&lt;br/&gt;','&quot;', '	', '\nl', '\r', '\rn', '\r\n', '\n\r','"', ']','['), '', $data);
					$data = nl2br($data);
					$data = explode('\nl', $data);
					$conff = "";
					foreach ($data as $k => $val)
					{
						$conff .= $val;
					}
					$conffGit = explode('<br />', $conff);
					foreach ($conffGit as $k => $v)
					{
						$v = explode('=',$v);
					
						if ( !empty($v[0]) && !empty($v[1]) )
						{
							$v[0] = preg_replace("/[^A-Za-z0-9 ]/", '',$v[0]);
							$conffGitSplit[$v[0]] = $v[1];
						}
					}
					if (!empty($conffGitSplit["url"]))
					{
						$siteList[$key]["link"] = $conffGitSplit["url"];
						if ( isset( explode( "github", $siteList[$key]["link"] )[1] ) )
						{
							$siteList[$key]["linkType"] = "github";
						}
						elseif ( isset( explode( "bitbucket", $siteList[$key]["link"] )[1] ) )
						{
							$siteList[$key]["linkType"] = "bitbucket";
						}
						else
						{
							$siteList[$key]["linkType"] = "git";
						}
					}	
				}
				elseif ( file_exists($confSvn) )
				{
					$siteList[$key]["linkType"] = "svn";
					$siteList[$key]["link"] = "#svn";
				}
			}
		}
		$this->smartyAssign( array('sites' => $siteList ) );
	}

	public function getBck( $siteName )
	{
		$folder = array(SHOOT_DIR, $siteName."/img", $siteName);
		$name = array($siteName, "screen", "screenshot", "logo", "maquette");
		$ext = array("png", "jpg", "svg", "gif");

		foreach ($folder as $k1 => $fileFold) 
		{
			foreach ($name as $k2 => $fileName)
			{
				foreach ($ext as $k3 => $fileExt)
				{
					if ( file_exists('myLocal/screen/' . $siteName . '.' . $fileExt) )
					{
						$img = 'myLocal/screen/' . $siteName . '.' . $fileExt;
						return $img;
						break;
					}
					elseif ( file_exists($fileFold . '/' . $fileName . '.' . $fileExt) )
					{
						$img = $fileFold . '/' . $fileName . '.' . $fileExt;
						return $img;
						break;
					}
				}
			}
		}
		return false;
	}

	public function getComitKey($checkFolder)
	{
		// TODO FETCH HEAD PARSING
		$confFile = $checkFolder."/.git/FETCH_HEAD";
		if (file_exists($confFile))
		{
			$fp = fopen($confFile, 'r');
			$data = fread($fp, 4096);
			$key = explode("	",$data)[0];
			return $key;
		}
		else
		{
			return false;
		}
	}
}
?>