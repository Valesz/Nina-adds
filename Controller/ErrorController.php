<?php

    namespace Application\Controller;

    include_once "Controller.php";

    /**
     * The controller that handles error pages.
     * 
     * @method array routes() - The available routes with their corressponding methods.
     * @method void loadErrorPage() - Renders the error page.
     * @method void load404Page() - Renders the error page with 404 credentials.
     */
    class ErrorController extends Controller {

        private $path = "error";

        /**
         * The info for page rendering.
         */
        private $info = [];

        /**
         * Sets the given values for the info property then renders the given page by the uri.
         */
        public function __construct($code = -1, $title = "", $description = "") {
            $this->info["code"] = $code !== -1 ? $code : "";
            $this->info["title"] = !empty($title) ? $title : "Unknown error";
            $this->info["description"] = !empty($description) ? $description : "Reach out to us to resolve the issue";

            parent::__construct();
        }

        /**
         * Available routes with their corresponding methods for this controller.
         * @return array - The available routes with their corresponding methods.
         */
        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path . "/404") => "load404Page",
                    ("/" . $this->path) => "loadErrorPage"
                ]
            ];
        }

        /**
         * Renders the default error page, with the given info from the constructor.
         */
        public function loadErrorPage() {

            Controller::render('error', $this->info);
        }

        /**
         * Renders the 404 page.
         */
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

