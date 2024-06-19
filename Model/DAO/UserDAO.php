<?php

namespace Application\Model\DAO;

use Application\Model\DAO\BaseDAO;
use Application\Model\DTO\UserModel;

require("BaseDAO.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Model/DTO/UserModel.php");

class UserDAO extends BaseDAO {

    private $table = "user";

    public function getAll() {
        $conn = $this->getConnection();
        $query = "SELECT * FROM `$this->table` WHERE 1";
        $result = $conn->query($query);

        if ($result->num_rows <= 0) {
            return [];
        }

        $users = [];

        while ($row = $result->fetch_assoc()) {
            $tmpUser = new UserModel();
            $tmpUser->setId($row['id'])->
                    setName($row['name']);
            
            $users[] = $tmpUser;
        }
        
        return $users;
    }
}