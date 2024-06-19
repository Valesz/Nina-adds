<?php

    namespace Application\Controller;

    use Application\Model\DAO\Interface\IUserDAO;
    use Application\Model\DAO\UserDAO;

    require_once "Controller.php";
    require_once "../Model/DAO/UserDAO.php";
    require_once "../Model/DAO/Interface/IUserDAO.php";

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
                ]
            ];
        }

        public function loadUsersPage() {
            $data["users"] = $this->userDAO->getAll();
            $data["singleUser"] = $this->userDAO->getRow(2);
            $this->render('users', $data);
        }
    }

    $controller = new UsersController();
