<?php

namespace Application\Model\DAO;

use Application\Model\DAO\BaseDAO;
use Application\Model\DAO\Interface\IUserDAO;
use Application\Model\DTO\UserModel;
use InvalidArgumentException;

require_once("BaseDAO.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Model/DTO/UserModel.php");
require_once("Interface/IUserDAO.php");

class UserDAO extends BaseDAO implements IUserDAO {

    private $table = "user";

    public function getAll(): array {
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

        $conn->close();
        
        return $users;
    }

    public function getRow($key) : UserModel {
        if (!is_int($key)) {
            throw new InvalidArgumentException("Given key with wrong type of key");
        }
        
        $conn = $this->getConnection();
        $query = "SELECT * FROM $this->table WHERE id = $key";
        $result = $conn->query($query);

        if ($result->num_rows <= 0) {
            return new UserModel();
        }

        $row = $result->fetch_assoc();

        $tmpObj = new UserModel();
        $tmpObj->setId($row['id'])->
                    setName($row['name']);

        return $tmpObj;
    }
}