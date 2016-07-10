<?php

class Router{

    protected $url;
    protected $method = 'index';

    function __construct()
    {

        $this->url = $this->getURL();

    }

    public function processURL()
    {

        // Check if home url
        if(empty($this->url[0])){
            $controllerPath = CONTROLLER_PATH . 'HomeController.php';
            $controllerName = 'HomeController';
        } else {
            $controllerPath = CONTROLLER_PATH . ucfirst($this->url[0]) . 'Controller.php';
            $controllerName = ucfirst($this->url[0]) . 'Controller';
        }

        // If controller does not exist then show error
        if (file_exists($controllerPath)) {
            require $controllerPath;
        } else {
            echo "Page not found";
            exit;
        }

        // Create a new instance
        $controller = new $controllerName;

        if ( isset($this->url[1]) ) {
            if (method_exists($controller, $this->url[1])) {
                $this->method = $this->url[1];
            } else {
                echo "Page not found";
                exit;
            }
        }

        // Call controller and method
        call_user_func_array([$controller, $this->method], []);

    }

    private function getURL()
    {

        $url = (isset($_GET['url'])) ? $_GET['url'] : '';
        $url = rtrim($url, '/');

        return explode('/', $url);

    }

}
