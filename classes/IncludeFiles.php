<?php

/**
*
*/
class IncludeFiles{

    //check for unwanted words
    function checkWords($input, $unwanted_words) {
            foreach ($unwanted_words as $value) {
                if(strpos($input, $value) !== false){ return false; }
            }
        return true;
    }

    //check for wanted words
    function checkWordsOposite($input, $wanted_words) {
            foreach ($wanted_words as $value) {
                if(strpos($input, $value) !== false){ return true; }
            }
        return false;
    }

        //  Includes css, JavaScript files and php includes
    public static function includedFiles($dir, $type, $words, $true=true, $nl=false){
        foreach (glob($dir.'*.'.$type) as $plugin){
            $checkWords = self::checkWords($plugin, $words);
            $checkWordsOposite = self::checkWordsOposite($plugin, $words);
            $op = ($true) ? $checkWords : $checkWordsOposite ;
            $nLr = ($nl) ? "newsletter/" : "" ;
            if ($op) {
                if ($type == 'js') {
            echo '<script type="text/javascript" src="'.SITE_URL.$nLr.$plugin.'"></script>';
            echo "\n";
                }
                if ($type == 'css') {
            echo '<link rel="stylesheet" type="text/css" href="'.SITE_URL.$nLr.$plugin.'" />';
            echo "\n";
                }
                if ($type == 'php') {
                echo include_once SITE_URL.$plugin."<br />";
                }
            }
        }
    }

    public static function includedFilesNL($dir, $type, $words, $true=true){
        foreach (glob($dir.'*.'.$type) as $plugin){
            $checkWords = self::checkWords($plugin, $words);
            $checkWordsOposite = self::checkWordsOposite($plugin, $words);
            $op = ($true) ? $checkWords : $checkWordsOposite ;

            if ($op) {
                if ($type == 'js') {
            echo '<script type="text/javascript" src="'.SITE_URL."newsletter/".$plugin.'"></script>';
            echo "\n";
                }
                if ($type == 'css') {
            echo '<link rel="stylesheet" type="text/css" href="'.SITE_URL."newsletter/".$plugin.'" />';
            echo "\n";
                }
                if ($type == 'php') {
                echo include_once $plugin."<br />";
                }
            }
        }
    }
}