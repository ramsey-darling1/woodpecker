<?php
/**
 * low level database interactions
 * @rdarling
 *
 */

class Db {
    
    public $db;
    public $collection;

    public function __construct($collection){
        //start up mondgo driver
        $mongo = new MondoClient();
        $this->db = $mongo->project_hours;
        $this->set_collection($collection);
    }

    public function set_collection($collection){
        $this->collection = $collection;
    }

    public function insert($document){
        $this->collection->insert($document);
    }

    public function re_all(){
        $dig = $this->collection->find();
        if(!empty($dig)){
            foreach($dig as $doc){
                $res[] = $doc;
            }
        }else{
            $res = false;
        }
        return $res;
    }

}