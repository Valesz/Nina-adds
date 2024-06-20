<?php

    namespace Application\Controller;

    /**
     * This class handles page loading and rendering of the pages.
     * Also this is an abstract class so the other controllers extend this.
     * 
     * @method void render(string $view, array $data = []) - This method renders the Views with the included data as variables
     * @method void loadPageForUrl() - Tries to find the uri in the routes and call the corressponding method.
     */
    abstract class Controller {

        /**
         * Returns the available routes for the controller in use.
         * 
         * @return array The available routes for the controller in use.
         */
        abstract protected function routes(): array;

        /**
         * Finds the uri route in the routes.
         */
        public function __construct() {
            $this->loadPageForUrl();    
        }

        /**
         * Renders the given view with the given data variables.
         * 
         * @param string $view - The view to render.
         * @param array $data - The list of variables to use in rendering.
         */
        public static function render(string $view, array $data = []) {
            extract($data);
    
            include "../View/$view.php";
        }

        /**
         * Tries to find a uri in the available routes, if successful calls it's method, if not renders 404 error page.
         */
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

