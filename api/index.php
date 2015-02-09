<?php
/**
 * Main Controller
 * here we break up the duties of each controller
 * into their own objects
 * @rdarling
 *
 */
session_start();

include_once 'helpers/messages.php';
include_once 'controllers/accounts.php';
include_once 'controllers/projects.php';
include_once '../models/Accounts.php';
include_once '../models/Projects.php';
include_once '../models/Db.php';

if(!empty($_POST['controller'])){
    //all post requests specify a controller
    //most posts requests will come through here
    switch($_POST['controller']){
        case 'account': 
            $controller = new AccountsController($_POST['action'],$_POST);
            break;
        case 'project':
            $controller = new ProjectsController($_POST['action'],$_POST);
            break;
        case 'hours':
            $controller = new HoursController($_POST['action'],$_POST);
            break;
    }
    $controller->action();//preform the requested action
    switch($controller->response_type()){
        case 'header': 
            $header = $controller->response();
            break;
        case 'res':
            $res = $controller->response();
            break;
        case 'message':
        default:
            $message = new Message($controller->message());
    }
}elseif(!empty($_GET['controller'])){
    //get requests that require interfacing with a model will come through here 
}else{
    //invalid request
}

//response
if(isset($header)){
    //set header to head to a location
    header("Location:/{$header}");
}elseif(isset($res)){
    //return data for ajax request
    echo $res;
}else{
    //return user message for ajax request
    echo $message->re_message();
}

