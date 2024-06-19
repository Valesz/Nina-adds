<?php

    namespace Application\Controller;

    include_once "Controller.php";

    class ErrorController extends Controller {

        private $path = "error";

        private $info = [];

        public function __construct($code = -1, $title = "", $description = "") {
            $this->info["code"] = $code !== -1 ? $code : "";
            $this->info["title"] = !empty($title) ? $title : "Unknown error";
            $this->info["description"] = !empty($description) ? $description : "Reach out to us to resolve the issue";

            parent::__construct();
        }

        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path . "/404") => "load404Page",
                    ("/" . $this->path) => "loadErrorPage"
                ]
            ];
        }

        public function loadErrorPage() {

            Controller::render('error', $this->info);
        }

        public function load404Page() {
            $this->info = [
                "code" => 404,
                "title" => "Page not found!",
                "description" => "This page does not exist!"
            ];

            $this->loadErrorPage();
            
        }
    }

    $controller = new ErrorController();

