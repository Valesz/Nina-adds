<?php

    namespace Application\Controller;

    use Application\Model\DAO\AdvertisementDAO;
    use Application\Model\DAO\Interface\IAdvertisementDAO;
    use Application\Model\DTO\AdvertisementModel;
    use Exception;

    require_once "Controller.php";
    require_once "../Model/DAO/AdvertisementDAO.php";
    require_once "../Model/DAO/Interface/IAdvertisementDAO.php";
    require_once "../Model/DTO/UserModel.php";

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
                ],
                "POST" => [
                    ("/" . $this->path . "/add") => "saveAdvertisement",
                    ("/" . $this->path . "/remove") => "removeAdvertisement"
                ]
            ];
        }

        public function loadAdvertisementsPage() {
            if (isset($_GET['failed'])) {
                $data['failed'] = true;
            }

            $data["adds"] = $this->addDAO->getAllWithNames();
            $this->render('advertisements', $data);
        }

        public function saveAdvertisement() {
            if (empty($_POST['userId']) || empty($_POST['title'])) {
                header("Location: /$this->path?failed=true");
                return;
            }

            $tmp = new AdvertisementModel();
            try {

                $tmp->setId(!empty($_POST['id']) ? intval($_POST['id']) : 0)
                    ->setUserId(intval($_POST['userId']))
                    ->setTitle($_POST['title']);
                $this->addDAO->save($tmp);

            } catch (Exception $e) {
                header("Location: /$this->path?failed=true");
                return;
            }
            
            header("Location: /$this->path");
        }

        public function removeAdvertisement() {
            if (empty($_POST['id'])) {
                
                header("Location: /$this->path");
                return;
            }

            try {

                $this->addDAO->remove($_POST['id']);

            } catch (Exception $e) {

                header("Location: /$this->path");
                return;
                
            }

            echo "success";
            header("Location: /$this->path");
        }
    }

    $controller = new AdvertisementsController();