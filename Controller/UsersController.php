<?php

    namespace Application\Controller;

    include "Controller.php";

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
            //$userDAO = new UserDAO();
            //$users = $userDAO->getAll();
            $this->render('users');
        }
    }

    $controller = new UsersController();
