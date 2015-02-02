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

default:
    $view = $account->is_logged_in() ? 'index' : 'main';
}

//include the view
include_once "views/{$view}.php";
