<?php

    namespace Application\Controller;

    include "Controller.php";

    class AdvertisementsController extends Controller {

        private $path = "advertisements";

        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadAdvertisementsPage"
                ]
            ];
        }

        public function loadAdvertisementsPage() {
            $this->render('advertisements');
        }
    }

    $controller = new AdvertisementsController();