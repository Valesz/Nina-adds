<?php

    namespace Application\Controller;

    use Application\Model\DAO\UserDAO;

    include_once "../Model/DAO/UserDAO.php";

    include_once "Controller.php";

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
            $users = ["users" => $userDAO->getAll()];
            $this->render('users', $users);
        }
    }

    $controller = new UsersController();
