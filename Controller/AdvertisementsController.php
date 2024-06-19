<?php

    namespace Application\Controller;

    use Application\Model\DAO\AdvertisementDAO;
    use Application\Model\DAO\Interface\IAdvertisementDAO;

    require_once "Controller.php";
    require_once "../Model/DAO/AdvertisementDAO.php";
    require_once "../Model/DAO/Interface/IAdvertisementDAO.php";

    class AdvertisementsController extends Controller {

        private $path = "advertisements";

        private IAdvertisementDAO $addDAO;

        public function __construct() {
            $this->addDAO = new AdvertisementDAO();
            parent::__construct();
        }

        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadAdvertisementsPage"
                ]
            ];
        }

        public function loadAdvertisementsPage() {
            
            $data["adds"] = $this->addDAO->getAll();
            $data["singleAdd"] = $this->addDAO->getRow(2);
            $this->render('advertisements', $data);
        }
    }

    $controller = new AdvertisementsController();