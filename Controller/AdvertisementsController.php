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

    /**
     * This class handles the routes for the advertisements page
     * 
     * @extends Controller
     * 
     * @method array routes() - return the available routes for this controller with their corresponding methods.
     * @method void loadAdvertisementsPage() - renders the default page for this controller.
     * @method void saveAdvertisements() - attempts to save the add then redirects back to default page of this controller.
     * @method void removeAdvertisement() - attempts to remove an add from the database.
     */
    class AdvertisementsController extends Controller {

        /**
         * The default path for this controller.
         */
        private string $path = "advertisements";

        /**
         * Interface DAO used.
         */
        private IAdvertisementDAO $addDAO;

        public function __construct() {
            $this->addDAO = new AdvertisementDAO();
            parent::__construct();
        }

        /**
         * Available routes with their corresponding methods for this controller.
         * @return array - The available routes with their corresponding methods.
         */
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

        /**
         * Renders the advertisements page.
         */
        public function loadAdvertisementsPage() {
            if (isset($_GET['failed'])) {
                $data['failed'] = true;
            }

            $data["adds"] = $this->addDAO->getAllWithNames();
            $this->render('advertisements', $data);
        }

        /**
         * Attempts to save the add then redirects back to default page of this controller.
         * It requires a POST request with 'id' to work.
         */
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

        /**
         *  Attempts to remove an add from the database.
         *  It requires a POST request with 'id' to work.
         */
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