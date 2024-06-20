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

    class UsersController extends Controller {

        private $path = "users";

        private IUserDAO $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
            parent::__construct();
        }

        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadUsersPage"
                ],
                "POST" => [
                    ("/" . $this->path . "/add") => "saveUser"
                ]
            ];
        }

        public function loadUsersPage() {
            if (isset($_GET['failed'])) {
                $data['failed'] = true;
            }

            $data["users"] = $this->userDAO->getAll();
            $this->render('users', $data);
        }

        public function saveUser() {
            if (empty($_POST['name'])) {
                header("Location: /users?failed=true");
                return;
            }

            $tmp = new UserModel();
            try {

                $tmp->setId(!empty($_POST['id']) ? intval($_POST['id']) : 0)
                    ->setName($_POST['name']);
                $this->userDAO->save($tmp);

            } catch (Exception $e) {
                header("Location: /users?failed=true");
                return;
            }
            
            header("Location: /users");
        }
    }

    $controller = new UsersController();
