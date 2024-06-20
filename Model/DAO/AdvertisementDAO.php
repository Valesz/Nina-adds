<?php

namespace Application\Model\DAO;

use Application\Model\DAO\BaseDAO;
use Application\Model\DTO\AdvertisementModel;
use Application\Model\DTO\UserModel;
use InvalidArgumentException;
use Application\Model\DAO\Interface\IAdvertisementDAO;

require_once("BaseDAO.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Model/DTO/AdvertisementModel.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Model/DTO/UserModel.php");
require_once("Interface/IAdvertisementDAO.php");

class AdvertisementDAO extends BaseDAO implements IAdvertisementDAO {

    private string $table = "advertisement";

    public function getAll() : array {
        $conn = $this->getConnection();
        $query = "SELECT * FROM `$this->table` WHERE 1";
        $result = $conn->query($query);

        if ($result->num_rows <= 0) {
            return [];
        }

        $adds = [];

        while ($row = $result->fetch_assoc()) {
            $tmpAdd = new AdvertisementModel();
            $tmpAdd->setId($row['id'])
                    ->setUserId($row['userId'])
                    ->setTitle($row['title']);
            
            $adds[] = $tmpAdd;
        }
        
        $conn->close();

        return $adds;
    }

    public function getAllWithNames() {
        $conn = $this->getConnection();
        $query = "SELECT advertisement.id as 'id', userId, title, name FROM `advertisement` 
            INNER JOIN `user` on user.id = advertisement.userId
            WHERE 1";
        $result = $conn->query($query);

        if ($result->num_rows <= 0) {
            return [];
        }

        while ($row = $result->fetch_assoc()) {
            $tmpAdd = new AdvertisementModel();
            $tmpAdd->setId($row['id'])
                    ->setUserId($row['userId'])
                    ->setTitle($row['title']);
            
            $tmpUser = new UserModel();
            $tmpUser->setId($row['userId'])
                    ->setName($row['name']);

            $adds[] = ["add" => $tmpAdd, "user" => $tmpUser];
        }

        $conn->close();

        return $adds;
    }

    public function getRow($key) : AdvertisementModel {
        if (!is_int($key)) {
            throw new InvalidArgumentException("Given key with wrong type of key");
        }
        
        $conn = $this->getConnection();
        $query = "SELECT * FROM $this->table WHERE id = $key";
        $result = $conn->query($query);

        if ($result->num_rows <= 0) {
            return new AdvertisementModel();
        }

        $row = $result->fetch_assoc();

        $tmpObj = new AdvertisementModel();
        $tmpObj->setId($row['id'])->
                    setUserId($row['userId'])->
                    setTitle($row['title']);

        $conn->close();

        return $tmpObj;
    }

    public function save($object): bool {
        if (!is_a($object, AdvertisementModel::class)) {
            throw new InvalidArgumentException("Given object is of the wrong type!");
        }

        $id = $object->getId();

        $conn = $this->getConnection();
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = $conn->query($query);

        $userId = $object->getUserId();
        $title = htmlspecialchars($object->getTitle());

        if ($result->num_rows <= 0) {
            $query = "INSERT INTO $this->table (userId , title) VALUES ($userId, '$title')";
            if ($conn->query($query)) {
                return true;
            }
            return false;
        } else {
            $query = "UPDATE $this->table SET userId = $userId, title = '$title' WHERE id = $id";
            if ($conn->query($query)) {
                return true;
            }  
            return false;
        }
    }

    public function remove($key): bool {
        if (is_int($key)) {
            throw new InvalidArgumentException("Given key with wrong type of key");
        }

        $conn = $this->getConnection();
        $query = "DELETE FROM $this->table WHERE id = $key";
        if ($conn->query($query)) {
            return true;
        }

        return false;
    }
}