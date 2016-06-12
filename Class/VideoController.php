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
