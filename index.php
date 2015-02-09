<?php
/**
 * Start, Heart, and Brain of the Application
 * a simple app to record hours against a project
 * @rdarling
 *
 */

session_start();//start the session

//include classes
include_once 'models/Accounts.php';
include_once 'models/Projects.php';
include_once 'models/Db.php';

$account = new Accounts();

//router
switch(@$_GET['page']){

case 'register':
    $view = 'register';
    break;

case 'new_project':
    $view = !$account->is_logged_in() ? 'index' : 'new_project';
    break;

case 'list_projects':
    if($account->is_logged_in()){
        $project = new Projects();
        $account_id = Accounts::re_static_id();
        $projects_list = $project->re_projects_list($account_id);
        $view = 'list_projects';
    }else{
        $view = 'index'; 
    }
    break;

case 'view_project':
    if($account->is_logged_in() and !empty($_GET['project'])){
        $project = new Projects();
        $project->set_id($_GET['project']); 
        $project->set_account_id(Accounts::re_static_id());
        $project_data = $project->is_users_project() ? $project->re_project() : null;
        $view = 'view_project';
    }else{
        $view = 'index'; 
    }
    break;

default:
    $view = !$account->is_logged_in() ? 'index' : 'main';
}
//include the view
include_once "views/{$view}.php";
