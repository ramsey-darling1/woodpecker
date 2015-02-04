<?php
/**
 * a class to handle accounts, logging in and out, etc
 * @rdarling
 *
 */

class Accounts {

    public $data;
    public $db;
    public $id;
    public $user;

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

    public function set_user($user){
        $this->user = $user; 
    }

    public static function re_static_id(){
        return isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
    }

    public function re_id(){
        return isset($this->id) ? $this->id : false; 
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
            $new_account = $this->db->insert_re_id('accounts',$cols,$vals,$ex_data);
            if(!empty($new_account) && strlen($new_account) < 26){
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
            $this->data['username'] = preg_replace('/ /','',$this->data['username']);//remove white space from username
            $res = true; 
        } 
        return $res;
    }

    /**
     * Login
     *
     */

    public function attempt_login($data){
        if(!empty($data['username']) && !empty($data['password'])){
            $this->set_data($data); 
            if(!$this->re_user('username')){
                $res = false; 
            }elseif(!$this->check_password()){
                $res = false; 
            }else{
                $this->login($this->id);
                $res = true; 
            }
        }else{
            $res = false; 
        }
        return $res;
    }

    public function is_valid_username(){
        //checks username and returns ID if it exists
        $dig = $this->db->select_specific('id','accounts','username = :username',array(':username'=>$this->data['username'])); 
        return !empty($dig) ? $this->set_id($dig['id']) : false;
    }

    public function check_password(){
        //this method expects that the re_user method has already been called and $this->user contains user data
        return password_hash($this->data['password'],PASSWORD_DEFAULT) == $this->user['password'] ? true : false;
    }

    /**
     * Set User
     *
     */
    
    public function re_user($key){
        //will return user data by ID, email, or username
        $dig = $this->db->select('accounts',array(':key'=>$this->data[$key]),"{$key} = :key"); 
        return !empty($dig) ? $this->set_user($dig[0]) : false;
    }
}
