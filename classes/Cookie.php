<?php
class Cookie {

	/**
	 * Checks if cookie exists
	 * @param  var $name the cookie name
	 * @return boolean       if cookie exists returns true else false
	 */
	public static function exists($name) {
		return (isset($_COOKIE[$name])) ? true : false;
	}

	/**
	 * Retreaves the cookie
	 * @param  var $name the cookie name
	 * @return $_COOKIE       returns the cookie
	 */
	public static function get($name) {
		return $_COOKIE[$name];
	}

	/**
	 * sets the values of the cookie
	 * @param  var $name   the cookie name
	 * @param  var $value  the cookie value
	 * @param  time $expiry sets expiration of cookie
	 * @return boolean         if cookie is set it returns true else false
	 */
	public static function put($name, $value, $expiry) {
		if(setcookie($name, $value, time() + $expiry, '/')) {
			return true;
		}
		return false;
	}

	/**
	 * Deletes the cookie
	 * @param  var $name the cookie name
	 * @return NOT       kills the cookie
	 */
	public static function delete($name) {
		self::put($name, '', time() - 1);
	}
}