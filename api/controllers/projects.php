<?php
/**
 * Controller for Projects
 * @rdarling
 *
 */

class Projects {
    
    public $project;
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
        return $this->project = new Project(); 
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
     * New Project
     *
     */

    public function new_project(){
        $this->set_response_type('message');
        $loggedin_id = Accounts::re_static_id();
        $new = $this->project->new_project($this->data,$loggedin_id); 
        return !$new ? $this->set_response('Sorry, we were not able to create a new project') :
                       $this->set_response('Thanks, project successfully created');  
    }
}
