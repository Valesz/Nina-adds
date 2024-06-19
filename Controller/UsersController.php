<?php

    namespace Application\Controller;

    use Application\Model\DAO\UserDAO;

    require_once "../Model/DAO/UserDAO.php";

    require_once "Controller.php";

    class UsersController extends Controller {

        private $path = "users";

        protected function routes(): array {
            return [
                "GET" => [
                    ("/" . $this->path) => "loadUsersPage"
                ]
            ];
        }

        public function loadUsersPage() {
            $userDAO = new UserDAO();
            $data["users"] = $userDAO->getAll();
            $data["singleUser"] = $userDAO->getRow(2);
            $this->render('users', $data);
        }
    }

    $controller = new UsersController();
