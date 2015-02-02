<?php
/**
 * Messages Class
 * builds user messages
 * @rdarling
 *
 */

class Message {

    public $message;
    public $message_type;
    public $message_class = 'alert-box radius';

    public function __construct($message_array=null){
        if(!empty($message_array)){
            $this->set_message($message_array[0]);
            $this->set_message_type($message_array[1]);
        } 
    }

    public function set_message($message){
        return $this->message = $message; 
    }

    public function set_message_type($message_type){
        return $this->message_type = $message_type; 
    }

    public function re_message(){
        return '<div class="'.$this->message_class.' '.$this->message_type.'">'.$this->message.'</div>'; 
    }
}
