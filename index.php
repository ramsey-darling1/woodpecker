<?php
/**
 * Start, Heart, and Brain of the Application
 * a simple app to record hours against a project
 * @rdarling
 *
 */

session_start();//start the session

$view = 'index';

//include the view
include_once "views/{$view}.php";
