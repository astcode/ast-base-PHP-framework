<?php

    function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    function hasIpHit(){
        $ip = Config::get('site/ip_address');
        $ip_filename = SITE_URL.'/counter/ip.txt';
        $file = file_get_contents($ip_filename);
        if (in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES))) {
            return true;
        }
        return false;
    }

    function inc_count(){
        $ip = Config::get('visitor/ip_address');
        $filename = 'counter/counter.txt';
        $ip_filename = 'counter/ip.txt';
        if (!in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES))) {
            $current_value = (file_exists($filename)) ? file_get_contents($filename) : 0 ;
            file_put_contents($ip_filename, $ip."\n", FILE_APPEND);
            file_put_contents($filename, ++$current_value);
        }
        $allhits_filename = 'counter/all_hits.txt';
        $allhits_value = (file_exists($allhits_filename)) ? file_get_contents($allhits_filename) : 0 ;
        file_put_contents($allhits_filename, ++$allhits_value);

    }

    function curPageURL() {
        $pageURL = 'http';
        if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    //check for unwanted words
    function checkWords($input, $unwanted_words) {
            foreach ($unwanted_words as $value) {
                if(strpos($input, $value) !== false){ return false; }
            }
        return true;
    }

    //check for unwanted words
    function checkWordsOposite($input, $wanted_words) {
            foreach ($wanted_words as $value) {
                if(strpos($input, $value) !== false){ return true; }
            }
        return false;
    }

    function includeFiles($dir, $type, $words, $true=true){
        foreach (glob($dir.'*.'.$type) as $plugin){
            $checkWords = checkWords($plugin, $words);
            $checkWordsOposite = checkWordsOposite($plugin, $words);
            $op = ($true) ? $checkWords : $checkWordsOposite ;
            if ($op) {
                if ($type == 'js') {
            echo '<script type="text/javascript" src="'.SITE_URL.$plugin.'"></script>';
            echo "\n";
                }
                if ($type == 'css') {
            echo '<link rel="stylesheet" type="text/css" href="'.SITE_URL.$plugin.'" />';
            echo "\n";
                }
                if ($type == 'php') {
                echo include_once $plugin."<br />";
                }
            }
        }
    }

    function isLocal(){
        return !checkdnsrr($_SERVER['SERVER_NAME'], 'NS');
    }

?>