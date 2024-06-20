<?php

    namespace Application\Controller;

    include "Controller.php";

    /**
     * The Controller for the home page (index page).
     * 
     * @method array routes() - Return the available routes for this controller with their corresponding methods.
     * @method loadHomePage() - Renders the home page.
     */
    class HomeController extends Controller {

        /**
         * The default path for this controller.
         */
        private $path = "home";

        /**
         * Available routes with their corresponding methods for this controller.
         * @return array - The available routes with their corresponding methods.
         */
        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadHomePage"
                ]
            ];
        }
        
        /**
         * Renders the home page.
         */
        public function loadHomePage() {
            $this->render('home');
        }

    }

    $controller = new HomeController();