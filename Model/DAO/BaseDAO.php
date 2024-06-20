<?php

namespace Application\Model\DAO;

use mysqli;
use Application\Model\DAO\Interface\IBaseDAO;

include_once "Interface/IBaseDAO.php";

/**
 * A MySQL "implementation" of a DAO to communicate with the database.
 * 
 * @method mysqli getConnection() - Return a mysqli connection.
 * @method array getAll() - Return an array of Objects from the database.
 * @method object getRow($key) - Return an object from the database with the given key.
 * @method bool save(Object $object) - Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
 * @method bool remove($key) - Attempts to remove the object with the given key from the database.
 */
abstract class BaseDAO implements IBaseDAO {

    /**
     * The host address to connect with to the database.
     */
    private string $address;

    /**
     * The username to connect with to the database.
     */
    private string $username;

    /**
     * The password to connect with to the database.
     */
    private string $password;

    /**
     * The name of the databse to connect to.
     */
    private string $database;

    /**
     * The relative path to the config file with the credentials to connect to the databse.
     */
    private string $configPath = "../../application.properties.json";

    /**
     * Inicializes the properties for the connection from the application.properties.json.
     */
    public function __construct() {
        $config = file_get_contents($this->configPath);
        
        $dbCredentials = json_decode($config, true)["DB_CREDENTIALS"];

        $this->address = $dbCredentials["ADDRESS"];
        $this->username = $dbCredentials["USERNAME"];
        $this->password = $dbCredentials["PASSWORD"];
        $this->database = $dbCredentials["DATABASE"];
    }

    /**
     *  Return a mysqli connection.
     *  @return \mysqli - The connection to the database.
     */    
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

    /**
     * Return an array of Objects from the database.
     * @return array - Objects from the databse.
     */
    abstract public function getAll(): array;

    /**
     * Return an object from the database with the given key.
     * @return object - An object from the database with the given key.
     */
    abstract public function getRow($key): object;

    /**
     * Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
     * @return bool - True if successful, False if not.
     */
    abstract public function save(object $object): bool;

    /**
     * Attempts to remove the object with the given key from the database.
     * @return bool - True if successful, False if not.
     */
    abstract public function remove($key): bool;
}

