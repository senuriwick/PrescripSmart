<?php

namespace Model;

if(!defined("ROOT")) die ("direct script access denied");

// authentication class
class Auth {

    // authenticate a user
    public static function authenticate($row) {
        if(is_object($row)) {
            $_SESSION['USER_DATA'] = $row;
        }
    }

    // logout a user
    public static function logout() {
        if(!empty($_SESSION['USER_DATA'])) {
            unset($_SESSION['USER_DATA']);
        }
    }

    // check whether a user is logged in or not
    public static function logged_in() {
        if(!empty($_SESSION['USER_DATA'])) {
            return true;
        }
        return false;
    }

    // get user attributes from USER_DATA
    public static function __callStatic($func_name, $args) {
        $key = str_replace("get", "", strtolower($func_name));
        if(!empty($_SESSION['USER_DATA']->$key)) {
            return $_SESSION['USER_DATA']->$key;
        }
        return '';
    } 

    // full user name
    public static function getFullName() {
        if(!empty($_SESSION['USER_DATA']->first_name) && !empty($_SESSION['USER_DATA']->last_name)) {
            return $_SESSION['USER_DATA']->first_name . " " . $_SESSION['USER_DATA']->last_name;
        }
        return '';
    }
}