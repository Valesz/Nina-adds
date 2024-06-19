<?php

    namespace Application\Controller;

    include "Controller.php";

    class HomeController extends Controller {

        private $path = "home";

        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadHomePage"
                ]
            ];
        }
        
        public function loadHomePage() {
            $this->render('home');
        }

    }

    $controller = new HomeController();