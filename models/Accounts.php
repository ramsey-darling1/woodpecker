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
        $this->db = new Db(); 
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

    public function set_data($data){
        $this->data = $data; 
    }

    /**
     * New Account
     *
     */

    public function new_account($data){
        $this->set_data($data);
        if($this->valid_new_account_data()){
            $cols = 'username, email, password, date_created, active';
            $vals = ':username, :email, :password, :date_created, :active';
            $ex_data = array(
                ':username' => trim($this->data['username']),
                ':email' => trim($this->data['email']),
                ':password' => password_hash($this->data['password'],PASSWORD_DEFAULT),
                ':date_created' => time(),
                ':active' => 1 
            );
            $new_account = $this->db->insert('accounts',$cols,$vals,$ex_data);
            if(!empty($new_account) && is_numeric($new_account)){
                //$new_account is a new user ID 
                $this->login($new_account);//login the new user
                $res = true;
            }else{
                $res = false; 
            }
        }else{
            $res = false; 
        } 
        return $res;
    }

    public function valid_new_account_data(){
        if(empty($this->data['username'])){
            $res = false; 
        }elseif(strlen($this->data['username']) < 6 || strlen($this->data['username']) > 25){
            $res = false; 
        }elseif(empty($this->data['email'])){
            $res = false; 
        }elseif(strpos($this->data['email'],'@') === false || strpos($this->data['email'],'.') === false){
            $res = false; 
        }elseif(empty($this->data['password'])){
            $res = false; 
        }elseif(strlen($this->data['password']) < 8){
            $res = false; 
        }else{
            $this->data['username'] = preg_replace(' ','',$this->data['username']);//remove white space from username
            $res = true; 
        } 
        return $res;
    }
}
