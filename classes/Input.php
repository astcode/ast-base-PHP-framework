<?php
class Input {
	public static function exists($type = 'post') {
		switch($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
			break;
			case 'get':
				return (!empty($_GET)) ? true: false;
			break;
			default:
				return false;
			break;
		}
	}

	public static function get($item) {
		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else if (isset($_GET[$item])) {
			return $_GET[$item];
		}

		return '';
	}

	public static function implodeArrayKeys($array){
        // first we get the array keys using array_keys() PHP function
        $keys = array_keys($array);
        // now join the keys into a string and separate using a comma
        $string = implode(", ",$keys);
        // and return the result
        return $string;
	}

	public static function searchInArrayKeyReturnValues($array, $needle, $delimiter=', ', $multi=false){
		// check if array else return false
		if (is_array($_POST)) {
			// transform the array into a string
			$haystack= static::implodeArrayKeys($array);
			// transform string into a more managable array
	        $explode = explode($delimiter, $haystack);
	        // iterate thru the array to find specified word
	        foreach ($explode as $value) {
	        	// search each word in the array and if it contains the needle
	        	// make it into a new array else also make the junk array
	            if (stripos($value, $needle)) {
	                $newArray[] = $value;
	            } else {
	                $junkArray[] = $value;
	            }
	        }
	        // if you need both of the arrays you can either return a
	        // multidimentional array containing both newArray and junkArray
	        // or just return the newArray, depending on application purpose.
	        if (!$multi) {
	        	return $newArray;
	        } else {
		        return $multiArray = array('newArray' => $newArray, 'junkArray', $junkArray );
        	}
		} else {
			// if its ont an array just return false
			// all it will break the method
			return false;
		}
	}
}