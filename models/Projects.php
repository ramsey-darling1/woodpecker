<?php
/**
 * Model for Projects
 * @rdarling
 *
 */

class Projects {
    
    public $db;
    public $id;
    public $data;
    public $account_id;

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

    public function set_account_id($account_id){
        $this->account_id = $account_id; 
    }

    /**
     * New Project
     *
     */

    public function new_project($data,$account_id){
        $this->set_data($data);
        $this->set_account_id($account_id);
        if($this->validate_project_data()){
            $id = $this->insert_project(); 
            if(!empty($id)){
                $this->set_id($id);  
                $this->tie_project_to_account();
                $res = true;
            }else{
                $res = false; 
            }
        }else{
            $res = false; 
        }
        return $res; 
    }

    public function insert_project(){
        $cols = 'name, description, date_created, active';
        $vals = ':name, :description, :date_created, :active';
        $ex_data = array(
            ':name' => $this->data['name'],
            ':description' => $this->data['description'],
            ':date_created' => time(),
            ':active' => 1 
        );
        $in = $this->db->insert_re_id('projects',$cols,$vals,$ex_data); 
        return !$in ? false : true;
    }

    public function tie_project_to_account(){
        $ex_data = array(':account'=>$this->account_id,':project'=>$this->id,':active'=>1);
        $in = $this->db->insert('account_projects','account, project, active',':account, :project, :active',$ex_data);      
        return !$in ? false : true;
    }

    public function validate_project_data(){
        if(empty($this->data['name'])){
            $res = false; 
        }elseif(strlen($this->data['name']) > 50){
            $res = false; 
        }elseif($this->is_duplicate_name()){
            $res = false; 
        }else{
            $res = true; 
        } 
        return $res;
    }

    public function is_duplicate_name(){
        $dig = $this->db->select('pid','projects','name = :name',array(':name'=>$this->data['name']),'active = 1'); 
        if(!empty($dig)){
            foreach($dig as $project){
                $ex_data = array(':account'=>$this->account_id,':project'=>$project['pid']);
                $check_project_owner = $this->db->select_specific('id','account_projects',
                    'project = :project',$ex_data,'account = :account AND active = 1'); 
                if(!empty($check_project_owner)){
                    $found = true; 
                }
            }
            $res = isset($found) ? true : false;
        }else{
            $res = false; 
        }
        return $res;
    }
}
