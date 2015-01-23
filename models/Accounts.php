<?php
/**
 * a class to handle accounts, logging in and out, etc
 * @rdarling
 *
 */

include_once 'Db.php';

class Accounts {

    public $data;
    public $db;

    public function __construct(){
        $this->set_db(); 
    }

    public function set_db(){
        $this->db = new Db('accounts'); 
    }
    
    public function login($id){
        return $_SESSION['logged_in'] = $id;
    }

    public function logout(){
        unset($_SESSION['logged_in']);
        return true;
    }

    public function is_logged_in(){
        return isset($_SESSION['logged_in']) ? true : false; 
    }

    /**
     * New Account
     *
     */

    public function new_account($data){
        if($this->valid_new_account_data()){
            $new_account = $this->db->insert();
            $res = !$new_account ? false : true;
        }else{
            $res = false; 
        } 
        return $res;
    }
}
