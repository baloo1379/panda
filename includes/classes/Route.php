<?php

class Route
{
	private static $validRoutes = array();

	private static function registerRoute($route, $function){
		self::$validRoutes[BASEDIR.$route] = $function;
	}

	public static function isValidRoute($route) {
		return array_key_exists($route, self::$validRoutes);
	}

	public static function set($route, $function) {
		if($_SERVER['REQUEST_URI'] == BASEDIR.$route) {
			self::registerRoute($route, $function);
			//$function->__invoke();
		}
		elseif (explode('?', $_SERVER['REQUEST_URI'])[0] == BASEDIR.$route) {
			self::registerRoute($route, $function);
			//$function->__invoke();
		}
		elseif ($_GET['url'] == $route){
			self::registerRoute($route, $function);
			//$function->__invoke();
		}
	}

	public static function invoke() {
        if (self::isValidRoute($_SERVER['REQUEST_URI'])) {
            call_user_func(self::$validRoutes[$_SERVER['REQUEST_URI']]);
        }
        elseif (self::isValidRoute(explode('?', $_SERVER['REQUEST_URI'])[0])) {
            call_user_func(self::$validRoutes[BASEDIR.'?'.$_GET['url']]);
        }
        elseif (self::isValidRoute(BASEDIR.'?'.$_GET['url'])){
            call_user_func(self::$validRoutes[BASEDIR.'?'.$_GET['url']]);
        }
        else {
            self::redirect('404');
        }
    }

	public static function redirect($route) {
		header('Location: '.BASEDIR.$route);
	}
}