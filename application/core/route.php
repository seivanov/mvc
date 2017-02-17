<?php

class Route
{

	static function start()
	{

		$controller_name = 'Main';
		$action_name = 'index';
		
		$_routes = explode('?', $_SERVER['REQUEST_URI']);
		$routes = explode('/', $_routes[0]);

		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}

		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}

		self::load_models();
		
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			$controller->$action();
		}
		else
		{
			Route::ErrorPage404();
		}
	
	}

	static function redirect($url) {
		header('Location:'.$url);
	}

	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }

	static function load_models() {

		$files = glob(BASEPATH . '/application/models/*.php');
		foreach($files as $file) {
			if(preg_match("#^model_(.+).php#", basename($file)))
				include "application/models/".basename($file);
		}

	}
    
}
