<?php
/**
 * ImgController
 *
 * @package MyLocal
 * @subpackage class
 */
class ImgController extends Controller
{
	private $ext = array("png", "jpg", "svg", "gif");
	private $maxw = 1000;
	private $maxh = 1000;
	private $maxs = 100000;
	private $target = SHOOT_DIR;
	/**
	 * __construct ImgController
	 * @author Golga
	 * @since 0.5.0
	 * @return boolean
	 */
	public function __construct( $smarty )
	{
		parent::__construct( $smarty );
		return true;
	}

	/**
	 * uplAll
	 * @author Golga
	 * @since 0.5.0
	 * @param  File $file 
	 * @return boolean
	 */
	public function uplAll( $file = null )
	{
		if ( $file === null )
		{
			$file = $_FILES;
		}
		foreach ($_FILES as $key => $file)
		{
			$rename = explode( "imgUpl_", $key );
			if ( empty( $rename[1] ) )
			{
				$rename = $key;
			}
			else
			{
				$rename = $rename[1];
			}
			if ( $this->isValid( $file ) && $this->cleanDir( $file, $rename ) )
			{
				$this->uplFile( $file, $rename );
			}
		}
		return true;
	}

	/**
	 * isValid
	 * @author Golga
	 * @since 0.5.0
	 * @param  File $file 
	 * @return boolean
	 */
	public function isValid( $file = null )
	{
		if ( $file === null )
		{
			$file = $_FILES;
		}
		if(
			!empty( $file['name'] )
			&& !empty( $file['tmp_name'] )
			&& isset( $file['error'] )
			&& in_array( strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) ), $this->ext )
		)
		{
			$infosImg = getimagesize( $file['tmp_name'] );
			if( 
				$infosImg[2] >= 1
				&& $infosImg[2] <= 14
				&& $infosImg[0] <= $this->maxw
				&& $infosImg[1] <= $this->maxh
				&& filesize( $file['tmp_name'] ) <= $this->maxs
				&& UPLOAD_ERR_OK === $file['error']
			)
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * cleanDir
	 * @author Golga
	 * @since 0.5.0
	 * @param  File $file 
	 * @param  String $rename 
	 * @return boolean
	 */
	public function cleanDir( $file = null, $rename = null )
	{
		if ( $file === null )
		{
			$file = $_FILES;
		}
		if ( $rename === null )
		{
			$rename = $_FILES['name'];
		}
		foreach ($this->ext as $key => $ext)
		{
			if ( file_exists( $this->target . '/' . $rename .'.'. $ext ) )
			{
				unlink( $this->target . '/' . $rename .'.'. $ext );
			}
		}
		return true;
	}

	/**
	 * uplFile
	 * @author Golga
	 * @since 0.5.0
	 * @param  File $file 
	 * @param  String $rename 
	 * @return boolean
	 */
	public function uplFile( $file = null, $rename = null )
	{
		if ( $file === null )
		{
			$file = $_FILES;
		}
		if ( $rename === null )
		{
			$rename = $_FILES['name'];
		}
		if( move_uploaded_file( $file['tmp_name'], $this->target . '/' . $rename .'.'. pathinfo( $file['name'], PATHINFO_EXTENSION ) ) )
		{
			return true;
		}
		return false;
	}
}