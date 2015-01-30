<?php
/**
 *Main Database class, all queries come through here
 *@rdarling
 */

 
class Db {
    
    private $name;
    private $user;
    private $host;
    private $pass;
    
    public function __construct($env='dev'){
        switch($env){            
            case 'dev':
                $this->set_dev_db();
                break;
            case 'staging':
                $this->set_staging_db();
                break;
            case 'live':
                $this->set_live_db();
                break;
        }
    }
    
    public function set_staging_db(){
        $this->name = '';
        $this->user = '';
        $this->host = '';
        $this->pass = '';
    }
    
    public function set_dev_db(){
        $this->name = 'scotchbox';
        $this->user = 'root';
        $this->host = 'localhost';
        $this->pass = 'root';
    }
 
    public function set_live_db(){
        $this->name = '';
        $this->user = '';
        $this->host = '';
        $this->pass = '';
    }
       
    public function re_name(){
        return $this->name;
    }
    
    public function re_host(){
        return $this->host;
    }
    
    public function re_user(){
        return $this->user;
    }
    
    public function re_pass(){
        return $this->pass;
    }
    
    public function query($query,$ex_data=null){
        //most generic query. just takes in an sql query
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = $query;
            $act = $conn->prepare($qu);
            isset($ex_data) ? $act->execute($ex_data) : $act->execute();
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    public function select($table_name, $ex_data = null, $where = null, $and = null){
        //database helper method to get stuff out of the db
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = "SELECT * FROM {$table_name}";
            if($where != null){
                $qu .= " WHERE {$where}";
            }
            if($and != null){
                $qu .= " AND {$and}";
            }
            $act = $conn->prepare($qu);
            isset($ex_data) ? $act->execute($ex_data) : $act->execute();
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    
    public function select_specific($col_name, $table_name, $where = null, $ex_data = null, $and = null){
        //database helper method to get stuff out of the db
        //allows for particular columns to be selected.
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = "SELECT {$col_name} FROM {$table_name}";
            if($where != null){
                $qu .= " WHERE {$where}";
            }
            if($and != null){
                $qu .= " AND {$and}";
            }
            $act = $conn->prepare($qu);
            isset($ex_data) ? $act->execute($ex_data) : $act->execute();
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }

    public function insert($table_name,$col_names,$values,$ex_data){
        //database helper method, controls inserts
        try {
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $qu = "INSERT INTO {$table_name} ({$col_names}) VALUES({$values})";
            $act = $conn->prepare($qu);
            $act->execute($ex_data);
            $res = $act->rowCount() >= 1 ? true : false; 
        }catch(PDOException $e){
            $res = $e;
        }
        return $res; 
    }
    
    public function update($table_name,$new_values,$where,$ex_data){
        //database helper method, controls updates
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $qu = "UPDATE {$table_name} SET {$new_values} WHERE {$where}";
            $act = $conn->prepare($qu);
            $test = $act->execute($ex_data);
            $res = $act->rowCount() >= 1 ? true : false; 
        }catch(PDOException $e){
            $res = $e;
        }
        return $res; 
    }

    public function delete($table_name,$where,$ex_data){
        //this method will delete a row from the database
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $qu = "DELETE FROM {$table_name} WHERE {$where}";
            $act = $conn->prepare($qu);
            $act->execute($ex_data);
            $res = $act->rowCount() >= 1 ? true : false; 
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    public function insert_re_id($table_name,$col_names,$values,$ex_data){
        //database helper method, controls inserts
        try {
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $qu = "INSERT INTO {$table_name} ({$col_names}) VALUES({$values})";
            $act = $conn->prepare($qu);
            $act->execute($ex_data);
            $res = $act->rowCount() >= 1 ? $res = $conn->lastInsertId() : false;
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    public function select_order_by($table_name, $orderby, $sort, $limit=null){
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = "SELECT * FROM {$table_name} ORDER BY {$orderby} {$sort}";
            if(isset($limit)){
                $qu .= " LIMIT {$limit}";
            }
            $act = $conn->prepare($qu);
            $act->execute();
            $res = $act->fetchAll();
            
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }

    public function select_where_order_by($table_name, $where, $orderby, $ex_data, $sort=null, $limit=null){
        //database helper method to get stuff out of the db
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = "SELECT * FROM {$table_name} WHERE {$where} ORDER BY {$orderby}";
            if (isset($sort)) {
                $qu .= " SORT {$sort}";
            }
            if(isset($limit)){
                $qu .= " LIMIT {$limit}";
            }
            $act = $conn->prepare($qu);
            $act->execute($ex_data);
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    public function select_sum($col_name, $table_name, $where = null, $ex_data = null, $and = null){
        //returns the sum of 1 column
        try{
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = "SELECT sum({$col_name}) FROM {$table_name}";
            if($where != null){
                $qu .= " WHERE {$where}";
            }
            if($and != null){
                $qu .= " AND {$and}";
            }
            $act = $conn->prepare($qu);
            !is_null($ex_data) ? $act->execute($ex_data) : $act->execute();
            $res = $act->fetch();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
}//end of Db class

