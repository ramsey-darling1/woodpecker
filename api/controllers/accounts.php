<?php
/**
 * Controller for Accounts
 * @rdarling
 *
 */

class AccountsController {
    
    public $account;
    public $action;
    public $data;
    public $message;
    public $response;
    public $response_type;

    public function __construct($action,$data){
        $this->set_action($action);
        $this->set_data($data); 
        $this->set_account_model();
    }

    public function set_data($data){
        return $this->data = $data; 
    }

    public function set_action($action){
        return $this->action = $action; 
    }

    public function set_account_model(){
        return $this->account = new Accounts(); 
    }

    public function set_response_type($type){
        return $this->response_type = $type; 
    }

    public function action(){
        //call the method 
        $action = $this->action;
        return $this->$action();
    }

    public function response(){
        return $this->response; 
    }

    public function response_type(){
        return $this->response_type; 
    }

    public function message(){
        return $this->message; 
    }

    public function set_message($message){
        return $this->message = $message; 
    }

    public function set_response($res){
        return $this->response = $res; 
    }
    
    /**
     * New Account
     *
     */

    public function new_account(){
        $this->set_response_type('res');
        $new = $this->account->new_account($this->data); 
        return !$new ? $this->set_response('Sorry, we were not able to create a new account at this time') :
                       $this->set_response('log_in'); 
    }

}
