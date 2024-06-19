<?php

namespace Application\Model\DAO;

use mysqli;

include_once "Interface/IBaseDAO.php";

abstract class BaseDAO implements IBaseDAO {
    private string $address;
    private string $username;
    private string $password;
    private string $database;

    private string $configPath = "../../application.properties.json";

    public function __construct() {
        $config = file_get_contents($this->configPath);
        
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

    abstract public function getAll();

    abstract public function getRow($key);

    //abstract public function save();
}

