<?php
class Hash {
	public static function make($string, $salt = '') {
		return hash('sha256', $string . $salt);
	}

	public static function salt($len) {
		// return mcrypt_create_iv($length);
		$random_text = "";
	    $length = $len;
	    $a = "";
	    $b = "";
	    $template = "1234567890";
	    $template .= "abcdefghijklmnopqrstuvwxyz";
	    $template .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    //$template .= "+_)(*&^%$#@!~`/.,<>?";
	    settype($length, "integer");
	    settype($random_text, "string");
	    settype($a, "integer");
	    settype($b, "integer");

	    for ($a = 1; $a <= $length; $a++) {
	        $b = rand(0, strlen($template) - 1);
	        $random_text .= $template[$b];
	    }

	    return $random_text;
	}

	public static function unique() {
		return self::make(uniqid());
	}
}