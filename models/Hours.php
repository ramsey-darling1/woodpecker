<?php
/**
 * Model for Hours
 * @rdarling
 *
 */

class Hours {
    
    public $db;
    public $id;
    public $data;

    public function __construct(){
        $this->set_db(); 
    }
    
    public function set_db(){
        $this->db = new Db(); 
    }

    public function set_id($id){
        $this->id = $id;  
    }

    public function set_data($data){
        $this->data = $data; 
    }

    /**
     * Record Hours
     *
     */

    public function record($data){
        $this->set_data($data);
        return $this->validate_data() ? $this->insert_hours() : false; 
    }

    public function insert_hours(){
        $cols = 'project, date_recorded, amount, start_time, end_time';
        $vals = ':project, :date_recorded, :amount, :start_time, :end_time';
        $ex_data = array(
            ':project' => $this->data['pid'],
            ':date_recorded' => $this->data['date'],
            ':amount' => $this->data['amount'],
            ':start_time' => '',
            ':end_time' => ''
        );
        $in = $this->db->insert_re_id('hours',$cols,$vals,$ex_data); 
        return !$in ? false : $in;
    }

    public function validate_data(){
        if(empty($this->data['project']) || empty($this->data['date']) || empty($this->data['amount'])){
            $res = false; 
        }elseif(!strtotime($this->data['date'])){
            $res = false; 
        }else{
            $this->data['date'] = strtotime($this->data['date']);
            $res = true; 
        } 
        return $res;
    }

    /**
     * List Hours
     *
     */

    public function re_project_hours($pid){
       $hours = $this->db->select('hours',array(':pid'=>$pid),'project = :pid');
       return !empty($hours) ? $hours : false;
    }
    
}
