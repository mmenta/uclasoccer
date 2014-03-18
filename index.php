<?php
// turn on error reporting
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


// Controller ============================

require('models/model.php');
require('includes/functions.php');


// Routing Functions =====================

$url = parseUrl($_SERVER['REQUEST_URI']);


// Load Model ============================

$Model = new Model($url);


// Manual Page Routing ===================

switch( $url[0] ) {

	case 'home':    $route = 'home.php';    $model = $Model->home();    break;
	case 'coach':   $route = 'coach.php';   $model = $Model->coach();   break;
	case 'program': $route = 'program.php'; $model = $Model->program(); break;
	case 'camps':   $route = 'camps.php';   $model = $Model->camps();   break;
	case 'social':  $route = 'social.php';  $model = $Model->social();  break;
	case 'japan':   $route = 'japan.php';   $model = $Model->japan();   break;
	default:        $route = 'home.php';    $model = $Model->home();

}


// Load Theme Template ===================

require('views/main-template.php');

?>


