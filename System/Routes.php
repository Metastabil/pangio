<?php
namespace Pangio;

class Routes {
    protected string $uriString;
    protected array $uriArray;
    protected array $routes;

    public function __construct() {
        $this->uriString = $_SERVER['REQUEST_URI'];
        $this->uriArray = explode('/', $this->uriString);
        $this->routes = $this->getAllRoutes();
        $this->modifyURIArray();
    }

    public function routing() :void {
        if (empty($this->uriArray[3])) {
            $routeArray = explode('/', $this->routes['defaultRoute']);

            $controller = $this->initializeControllerClass($routeArray[0]);
            $method = $routeArray[1];

            call_user_func_array([$controller, $method], []);
        }
        else {
            $controller = $this->initializeControllerClass($this->uriArray[3]);
            $method = $this->uriArray[4];

            call_user_func_array([$controller, $method], []);
        }
    }

    public function getRequestedURI() :string {
        return $this->uriString;
    }

    /* Private Methods */
    private function getAllRoutes() :array {
        $path = dirname(__DIR__) . '/Config/Routes.php';

        if (!is_file($path)) die('Error! The following file is missing: Config/Routes.php');

        include $path;

        return $routes;
    }

    private function modifyURIArray() :void {
        $uriArray = $this->uriArray;

        unset($uriArray[0]);
        unset($uriArray[1]);
        unset($uriArray[2]);

        $this->uriArray = $uriArray;
    }

    private function initializeControllerClass(string $controller) :mixed {
        $controllerClass = 'Controllers\\' . $controller;

        return new $controllerClass();
    }
}