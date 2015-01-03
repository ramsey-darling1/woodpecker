<?php
/**
 * a class to handle accounts, logging in and out, etc
 * @rdarling
 *
 */
session_start();

class Accounts {
    
    public function login($id){
        return $_SESSION['logged_in'] = $id;
    }

    public function logout(){
        unset($_SESSION['logged_in']);
        return true;
    }
}
