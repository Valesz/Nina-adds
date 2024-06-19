<?php

namespace Application\Model\DAO;

use mysqli;

include_once "Interface/IBaseDAO.php";

class BaseDAO implements IBaseDAO {
    private $address;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $config = file_get_contents("../../application.properties.json");
        
        $dbCredentials = json_decode($config, true)["DB_CREDENTIALS"];

        $this->address = $dbCredentials["ADDRESS"];
        $this->username = $dbCredentials["USERNAME"];
        $this->password = $dbCredentials["PASSWORD"];
        $this->database = $dbCredentials["DATABASE"];
    }

    public function getConnection(): mysqli {
        $connection = new mysqli($this->address,
                                    $this->username,
                                    $this->password,
                                    $this->database,);
        
        if ($connection->connect_error) {
            die("Failed to connect to database!");
        }

        return $connection;
    }
}

