<?php

    namespace Application\Controller;

    use Application\Model\DAO\Interface\IUserDAO;
    use Application\Model\DAO\UserDAO;
    use Application\Model\DTO\UserModel;

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
                ]
            ];
        }

        public function loadUsersPage() {
            $tmp = new UserModel();
            $tmp->setId(0)->setName("valesz");
            $this->userDAO->save($tmp);

            $data["users"] = $this->userDAO->getAll();
            $data["singleUser"] = $this->userDAO->getRow(1);
            $this->render('users', $data);
        }
    }

    $controller = new UsersController();
