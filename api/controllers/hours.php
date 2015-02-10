<?php
/**
 * Controller for Projects
 * @rdarling
 *
 */

class HoursController {
    
    public $pid;//project ID
    public $hours;
    public $action;
    public $data;
    public $message;
    public $response;
    public $response_type;

    public function __construct($action,$data){
        $this->set_action($action);
        $this->set_data($data); 
        $this->set_model();
    }

    public function set_data($data){
        return $this->data = $data; 
    }

    public function set_action($action){
        return $this->action = $action; 
    }

    public function set_model(){
        return $this->hours = new Hours(); 
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

    public function set_pid($pid){
        return $this->pid = $pid; 
    }

    /**
     * Record Hours
     *
     */

    public function record_hours(){
        $this->set_response_type('res');
        $save = $this->hours->record($this->data); 
        return !$save ? $this->set_response('fail') : $this->set_response('success');  
    }
}
