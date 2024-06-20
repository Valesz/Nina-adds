<?php

    namespace Application\Controller;

    use Application\Model\DAO\Interface\IUserDAO;
    use Application\Model\DAO\UserDAO;
    use Application\Model\DTO\UserModel;
    use Exception;

    require_once "Controller.php";
    require_once "../Model/DAO/UserDAO.php";
    require_once "../Model/DAO/Interface/IUserDAO.php";
    require_once "../Model/DTO/UserModel.php";

    /**
     * This is the controller for the users page.
     * 
     * @extends Controller
     * 
     * @method array routes() - return the available routes for this controller with their corresponding methods.
     * @method void loadUsersPage() - Renders the users page.
     * @method void saveAdvertisements() - Attempts to save the user then redirects back to default page of this controller.
     * @method void removeAdvertisement() - Attempts to remove a user from the database.
     */
    class UsersController extends Controller {

        /**
         * The default path for this controller.
         */
        private $path = "users";

        /**
         * Interface DAO used.
         */
        private IUserDAO $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
            parent::__construct();
        }

        /**
         * Available routes with their corresponding methods for this controller.
         * @return array - The available routes with their corresponding methods.
         */
        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadUsersPage"
                ],
                "POST" => [
                    ("/" . $this->path . "/add") => "saveUser",
                    ("/" . $this->path . "/remove") => "removeUser"
                ]
            ];
        }

        /**
         * Renders the users page.
         */
        public function loadUsersPage() {
            if (isset($_GET['failed'])) {
                $data['failed'] = true;
            }

            $data["users"] = $this->userDAO->getAll();
            $this->render('users', $data);
        }

        /**
         * Attempts to save the user then redirects back to default page of this controller. 
         */
        public function saveUser() {
            if (empty($_POST['name'])) {
                header("Location: /$this->path?failed=true");
                return;
            }

            $tmp = new UserModel();
            try {

                $tmp->setId(!empty($_POST['id']) ? intval($_POST['id']) : 0)
                    ->setName($_POST['name']);
                $this->userDAO->save($tmp);

            } catch (Exception $e) {
                header("Location: /$this->path?failed=true");
                return;
            }
            
            header("Location: /$this->path");
        }

        /**
         *  Attempts to remove a user from the database. 
         *  It requires a POST request with 'id' to work.
         */
        public function removeUser() {
            if (empty($_POST['id'])) {
                
                header("Location: /$this->path");
                return;
            }

            try {

                $this->userDAO->remove($_POST['id']);

            } catch (Exception $e) {

                header("Location: /$this->path");
                return;
                
            }

            echo "success";
            header("Location: /$this->path");
        }
    }

    $controller = new UsersController();
