<?php
/**
 * Config Reader
 *
 * @package MyLocal
 * @author Jiedara
 * @since 0.4
 * A class that permit to read and use user friendly config.json
 */

class ConfigReader{

	private $configJsonPath;
	private $configJson;
	private $mainFolderName;
	private $templateName;

	/**
	 * __construct ConfigReader
	 * @author Jiedara
	 * @since 0.4
	 * @return boolean
	 */
	public function __construct( $mainFolderName , $templateName, $configJsonPath = null)
	{
		$this->mainFolderName = $mainFolderName;
		$this->templateName = $templateName;
		$this->configJson = false;
		$this->configRoot();
		$this->configJsonPath = CUSTOM_FOLD . '/config.json';
		if ( file_exists( $this->configJsonPath ) )
		{
			$this->configJson = json_decode( file_get_contents( $this->configJsonPath ) );
			if( !empty( $this->configJson->templateName ) )
			{
				$this->templateName = $this->configJson->templateName;
			}
		}
		
		$this->configMain();
	}

	public function getConfig($key = false)
	{
		if ( empty( $this->configJson ) )
		{
			return false;
		}
		else
		{
			if( $key && isset( $this->configJson->$key ) )
			{
				return $this->configJson->$key;
			}
			else
			{
				return $this->configJson;
			}
		}
	}

	public function getControllerName()
	{
		$controllerName = $this->getConfig( "myLocalUse" ); 
		if ( !empty( $controllerName ) )
		{
			return ucfirst( $userConfigs->myLocalUse ) . "Controller";
		}
		else
		{
			return "FrontController";
		}
	}

	//real path myLocal
	public function rp( $path )
	{
		$out = array();
		foreach(explode('/', $path) as $i=>$fold)
		{
			if ( $fold == '' || $fold == '.')
			{
				continue;
			}
			elseif ($fold == '..' && $i > 0 && end($out) != '..')
			{
				array_pop($out);
			}
			else
			{
				$out[]= $fold;
			}
		}
		return ($path{0}=='/'?'/':'').join('/', $out);
	}

	//define config root
	public function configRoot()
	{
		$root = explode( basename($_SERVER['PHP_SELF']), $_SERVER["PHP_SELF"] );
		$InFold = explode( $this->mainFolderName, $root[0] );
		// check path

		if ( !empty($this->mainFolderName) )
		{
			if ( isset($InFold[1]) )
			{
				chdir("..");
			}
			elseif( $InFold[0] != "/" )
			{
				$depth = "";
				$scan = "";
				foreach ($InFold as $key => $value)
				{
					$value = explode("/", $value);
					foreach ($value as $k => $v)
					{
						if ( $k != 0 && !empty($v) )
						{
							$depth .= "../";
							$scan .= "/" . $v;
						}
					}
				}
				define("SCAN_DIR", ".".$scan);
				chdir($depth);
			}
			define("ROOT_DIR", $this->mainFolderName);
			define("MAIN_FOLDER_NAME", $this->mainFolderName);
			define("ROOT_LOCAL", "http://" . $_SERVER['HTTP_HOST'] . "/" );
			define("ROOT_URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . ROOT_DIR);
		}
		else
		{
			define("ROOT_DIR",$root[0]);
			define("ROOT_URL", "http://" . $_SERVER['HTTP_HOST'] . ROOT_DIR);
		}
		if ( !defined("SCAN_DIR") )
		{
			define("SCAN_DIR", "./");
		}
		define("URL_DOM", "http://" . $_SERVER['HTTP_HOST'] . "/" );
		define("CONFIG_DIR", $this->rp(ROOT_DIR . "/config") );
		define("CUSTOM_FOLD", $this->rp(ROOT_DIR . "/config-user") );
		define("SHOOT_DIR", $this->rp( CUSTOM_FOLD. "/img") );
	}

	public function configMain()
	{
		// class
		define("CLASS_DIR", $this->rp( ROOT_DIR . "/Class" ) );
		define("SMARTY_DIR", CLASS_DIR . "/Smarty");
		define("SMARTY_SYSPLUGINS_DIR", SMARTY_DIR . "/sysplugins/");//END slashess used in smarty class
		define("SMARTY_PLUGIN", SMARTY_DIR . "/plugins/");//END slashess used in smarty class

		// cache
		define("CACHE_DIR", $this->rp( ROOT_DIR . "/cache" ) );
		define("CACHE_SMARTY_DIR", CACHE_DIR . "/.smarty-cache");
		define("CACHE_SMARTY_COMPILE", CACHE_DIR . "/.smarty-compile");

		// Templates
		define("TEMPLATE_EXT", $this->rp(".tpl") );
		define("TEMPLATE_DIR", $this->rp( ROOT_DIR . "/templates/" . $this->templateName) );
		define("IMG_DIR", TEMPLATE_DIR . "/img");
		define("JS_DIR", TEMPLATE_DIR . "/js");
		define("CSS_DIR", TEMPLATE_DIR . "/css");
	}

	/**
	 * __destruct
	 *
	 * @author Jiedara
	 * @since 0.4
	 * @param none
	 * @return boolean
	*/
	public function __destruct()
	{
		return true;
	}

}
