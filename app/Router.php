<?php

namespace App;

use AltoRouter;

class Router {

    public $viewPath;
    private $router;

    public function __construct(string $viewPath){
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, $name= null){
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, $name= null){
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }

    public function run(){
        $match = $this->router->match();
        if (is_array($match)) {
            $params = $match['params'];
            ob_start();
            require_once dirname(__DIR__)."/app/Views/{$match['target']}.php";           
            $pageContent = ob_get_clean();
            require_once dirname(__DIR__)."/templates/default.php";
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'GET'){
             require_once dirname(__DIR__)."/templates/error.php";
            } 
        }      
    }
}