<?php

namespace Application\Model\DAO;

use Application\Model\DAO\BaseDAO;
use Application\Model\DAO\Interface\IUserDAO;
use Application\Model\DTO\UserModel;
use InvalidArgumentException;

require_once("BaseDAO.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Model/DTO/UserModel.php");
require_once("Interface/IUserDAO.php");

/**
 * A MySQL implementation to communicate with the database, more specifically with the users table.
 * 
 * @method array getAll() - Return an array of UserModels from the database.
 * @method UserModel getRow(int $key) - Return an object of UserModel from the database with the given key.
 * @method bool save(UserModel $object) - Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
 * @method bool remove(int $key) - Attempts to remove the object with the given key from the database.
 */
class UserDAO extends BaseDAO implements IUserDAO {

    /**
     * The table name for the DAO to mainly communicate with.
     */
    private $table = "user";

    /**
     * Return an array of UserModels from the database.
     * @return array - The users present in the database as an array of UserModels.
     */
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

    /**
     * Return an object of UserModel from the database with the given key.
     * @return UserModel - an UserModel from the database with the given key.
     */
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

        $conn->close();

        return $tmpObj;
    }

    /**
     * Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
     * @return bool - True if it did anything, False if not.
     */
    public function save($object): bool {
        if (!is_a($object, UserModel::class)) {
            throw new InvalidArgumentException("Given object is of the wrong type!");
        }

        $id = $object->getId();

        $conn = $this->getConnection();
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = $conn->query($query);

        $name = htmlspecialchars($object->getName());

        if ($result->num_rows <= 0) {
            $query = "INSERT INTO $this->table (name) VALUES ('$name')";
            if ($conn->query($query)) {
                return true;
            }
            return false;
        } else {
            $query = "UPDATE $this->table SET name = '$name' WHERE id = $id";
            if ($conn->query($query)) {
                return true;
            }  
            return false;
        }
    }

    /**
     * Attempts to remove the object with the given key from the database.
     * @return bool - True if it did anything, False if not.
     */
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