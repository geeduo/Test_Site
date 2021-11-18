<?php
namespace components;


class Router {

	private $routes;

	public function __construct()
	{
		$routesPath ='config/routes.php';
		$this->routes = require($routesPath);
	}

	private function getURI()
	{
		$requestUri = $_SERVER['REQUEST_URI'];

		if (!empty($requestUri))
		{
			return trim($requestUri, '/');
		}
	}

	public function run()
	{

		$uri = $this->getURI();

		foreach ($this->routes as $uriPattern => $path)
		{
			if (preg_match("~$uriPattern~", $uri))
			{
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				$segments = explode('/', $internalRoute);
				$controllerName = 'controllers\\'.ucfirst(array_shift($segments)).'Controller';
				$actionName = 'action'.ucfirst(array_shift($segments));
				$controllerObject = new $controllerName;
				$result = call_user_func_array(array($controllerObject, $actionName), $segments);
				if ($result == null)
				{
					break;
				}
			}
		}
	}
}