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
	 * @since 0.4.3
	 * @return boolean
	 */
	public function __construct( $smarty )
	{
		parent::__construct( $smarty );
		return true;
	}

	public function uplAll()
	{
		foreach ($_FILES as $key => $file)
		{
			if ( $this->isValid( $file ) )
			{
				$rename = explode( "imgUpl_", $key );
				if ( empty( $rename[1] ) )
				{
					$this->uplFile( $file, $rename[0] );
				}
				else
				{
					$this->uplFile( $file, $rename[1] );
				}
			}
		}
		return true;
	}

	public function isValid( $file )
	{
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
			echo  $this->target . '/' . $rename .'.'. pathinfo( $file['name'], PATHINFO_EXTENSION );
			return true;
		}
		return false;
	}
}