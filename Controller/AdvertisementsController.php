<?php

    namespace Application\Controller;

    use Application\Model\DAO\AdvertisementDAO;

    require_once "Controller.php";
    require_once "../Model/DAO/AdvertisementDAO.php";

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
            $addDAO = new AdvertisementDAO();
            $data["adds"] = $addDAO->getAll();
            $data["singleAdd"] = $addDAO->getRow(2);
            $this->render('advertisements', $data);
        }
    }

    $controller = new AdvertisementsController();