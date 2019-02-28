<?php

define('BASEDIR', '/panda/');
define('SITE_NAME', 'Panda');

session_start();

function loader($class_name) {
	if(file_exists("./includes/classes/$class_name.php")) {
		require_once "./includes/classes/$class_name.php";
	}
	elseif (file_exists("./includes/controllers/$class_name.php")) {
		require_once "./includes/controllers/$class_name.php";
	}
}



spl_autoload_register('loader');

require_once 'Routes.php';