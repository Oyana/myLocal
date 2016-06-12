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

	private $configJsonPath = './config.json';
    private $configJson;

	/**
	 * __construct ConfigReader
	 * @author Jiedara
	 * @since 0.4
	 * @return boolean
	 */
	public function __construct( $configJsonPath = null)
	{
		if(!empty($configJsonPath)){
            $this->configJsonPath = $configJsonPath;
        }else {
            $this->configJsonPath = $this->configJsonPath;
        }
        $this->configJson = json_decode(file_get_contents($this->configJsonPath));
	}

    public function getConfig(){
        return $this->configJson;
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
		unset($this->configJsonPath);
		return true;
	}

}
