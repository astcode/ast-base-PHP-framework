<?php

class Config {

	/**
	 * List of all loaded config values
	 *
	 * @var	array
	 */
	public $config = array();

	/**
	 * List of all loaded config files
	 *
	 * @var	array
	 */
	public $is_loaded =	array();

	/**
	 * List of paths to search when trying to load a config file.
	 *
	 * @used-by	CI_Loader
	 * @var		array
	 */
	public $_config_paths =	array(APPPATH);

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * Sets the $config data from the primary config.php file as a class variable.
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->config =& get_config();

		// Set the base_url automatically if none was provided
		if (empty($this->config['base_url']))
		{
			// The regular expression is only a basic validation for a valid "Host" header.
			// It's not exhaustive, only checks for valid characters.
			if (isset($_SERVER['HTTP_HOST']) && preg_match('/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST']))
			{
				$base_url = (is_https() ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST']
					.substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
			}
			else
			{
				$base_url = 'http://localhost/';
			}

			$this->set_item('base_url', $base_url);
		}

		log_message('info', 'Config Class Initialized');
	}

	// --------------------------------------------------------------------

	public static function get($path = null) {
		if($path) {
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach($path as $bit) {
				if(isset($config[$bit])) {
					$config = $config[$bit];
				}
			}

			return $config;
		}

		return false;
	}

	public static function base_url($uri = '') {
		return self::slash_item('site/base_url').ltrim(self::_uri_string($uri), '/');
	}

	public static function site_url($uri = '') {
		$base_url = self::slash_item('site/base_url').ltrim(self::_uri_string($uri), '/');
		$index_page = self::slash_item('site/index_page').ltrim(self::_uri_string($uri), '/');
		return $base_url.$index_page;
	}

	public static function slash_item($item="")
	{

		$this_item =  self::get($item);

		if (!isset($this_item))
		{
			return FALSE;
		}
		if (!$this_item) {
			return FALSE;
		}
		if (empty($this_item)) {
			return FALSE;
		}
		if(is_array($this_item))
		{
			// $this_item = self::_return_closest_match($item, $this_item);
			// echo self::_return_closest_slash_item($this_item);
		 //    rtrim($this_item, '/').'/';
			return FALSE;
		}
		if (!is_array($this_item)) {
			return rtrim($this_item, '/').'/';
		} else {
			return FALSE;
		}

	}

	protected static function _uri_string($uri)
	{
		if (self::get('site/enable_query_strings') == FALSE) {
			if (is_array($uri))
			{
				$uri = implode('/', $uri);
			}
			$uri = trim($uri, '/');
		} else {
			if (is_array($uri)) {
				$i = 0;
				$str = '';
				foreach ($uri as $key => $val) {
					$prefix = ($i == 0) ? '' : '&';
					$str .= $prefix.$key.'='.$val;
					$i++;
				}
				$uri = $str;
			}
		}
	    return $uri;
	}




	private static function _return_closest_slash_item($item){
		return self::get($item);
	}


	protected static function _return_closest_match($item, $this_item){
		$input = $item;
		$shortest = -1;
		foreach ($this_item as $word=>$w) {
		    $lev = levenshtein($input, $word);
		    if ($lev == 0) {
		        $closest = $word;
		        $shortest = 0;
		        break;
		    }
		    if ($lev <= $shortest || $shortest < 0) {
		        $closest  = $word;
		        $shortest = $lev;
		    }
		}
		return (string)$this_item = $closest;
		// echo $this_item;
	}
}