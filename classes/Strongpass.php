<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of strongpass
 *
 * @author Aaron
 */
class Strongpass {

    public static function check($password) {
        $response = "OK";

        if (strlen($password) < 6) {
            $response = "Password must be at least 6 characters";
        } else if (is_numeric($response)) {
            $response = "Password must contain atleast one letter";
        } else if (!preg_match('#[0-9]#', $password)) {
            $response = "Password must contain atleast one number";
        } else if (!preg_match('#[A-Z]#', $password)) {
            $response = "Password must contain atleast one UpperCase letter";
        } else if (!preg_match('#[a-z]#', $password)) {
            $response = "Password must contain atleast one LowerCase letter";
        }  else if(!preg_match('/[@!#]/', $password)){
            $response = "Password must contain atleast one one of these symbols @!#";
        }

        return $response;
    }

    public static function forbiden_password($password) {
        $response = "OK";
        $stringtocheck = $password;
        $forbiddenword = 'password';
        if (preg_match("/$forbiddenword/i", $password)) {
            $response = "The Password canNOT contain the string {$forbiddenword}";
        }
        return $response;
    }

}

?>
