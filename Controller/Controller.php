<?php

    namespace Application\Controller;

    abstract class Controller {

        abstract protected function routes(): array;

        public function __construct() {
            $this->loadPageForUrl();    
        }

        public static function render(string $view, array $data = []) {
            extract($data);
    
            include "../View/$view.php";
        }

        protected function loadPageForUrl() {
            $uri = strtok($_SERVER['REQUEST_URI'], "?");
            $method = $_SERVER['REQUEST_METHOD'];

            if (array_key_exists($uri, $this->routes()[$method])) {
                $action = $this->routes()[$method][$uri];
                
                $this->$action();
                return;
            }

            $info = [
                "code" => 404,
                "title" => "Page not Found!",
                "description" => "This page does not exist."
            ];
            $this->render('error', $info);
            
            http_response_code(404);
            
        }
    }

