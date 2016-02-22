<?php
/**
 * ModulesController
 *
 * @package GuildPanel
 * @subpackage class
 */
class Controller
{
	protected $smarty;
	protected $db;

	/**
	 * __construct moduleController
	 * @author Golga
	 * @since 0.2
	 * @param	object		$smarty
	 * @param	object		$db
	 */
	public function __construct( $smarty, $db = false )
	{
		$this->smarty = $smarty;
		$this->db = $db;
		return true; 
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
		unset($this->smarty);
		unset($this->db);
		return true; 
	}

	/**
	 * smartyAssign
	 * @author Golga
	 * @since 0.2
	 * @param	array	$data
	 */
	public function smartyAssign( $data )
	{
		if ( is_array($data) )
		{
			foreach ($data as $key => $value)
			{
				$this->smarty->assign( $key, $value );
			}
		}
		else
		{
			return false;
		}
		return true; 
	}

	/**
	 * smartyAssign
	 * @author Golga
	 * @since 0.2
	 * @param	array	$data
	 */
	public function smartyDisplay( $data )
	{
		if ( is_array($data) )
		{
			foreach ($data as $key => $value)
			{
				$this->smarty->display( $value . TEMPLATE_EXT );
			}
		}
		else
		{
			$this->smarty->display( $data . TEMPLATE_EXT );
		}
		return true; 
	}
}