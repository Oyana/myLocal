<?php
/**
 * FrontController
 *
 * @package MyLocal
 * @subpackage class
 */
class VideoController extends FrontController
{
	private $templateList;
	private $userConfig;

	/**
	 * __construct VideoController
	 * @author Jiedara
	 * @since 0.4
	 * @return boolean
	 */
	public function __construct( $smarty )
	{
		parent::__construct( $smarty );
	}

	public function getList()
	{
		$files = scandir('./Vidéos');
		$realpath = str_replace(array('/', '\\'),'',explode( ":",realpath('.') )[0]);
		$siteList = array();
		foreach ($files as $key => $value)
		{
			if (
					isset( $value )
				&&	$value != "."
				&&	$value != ".."
				&&	!is_file( $value )
			){
				$siteList[$key]["name"] = $value;
				$siteList[$key]["local_link"] = ROOT_LOCAL . $value;
				// reset var
				$siteList[$key]["img"] = "";
				$siteList[$key]["baseUrl"] = "";
				$siteList[$key]["identifier"] = "";
				$siteList[$key]["link"] = "";
				$siteList[$key]["linkType"] = "";
				$siteList[$key]["img"] = $this->getBck( $siteList[$key]["name"] );
			}
		}
		$this->smartyAssign( array('datas' => $siteList ) );
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
		parent::__destruct();
		unset($this->templateList);
		return true;
	}

}
?>
