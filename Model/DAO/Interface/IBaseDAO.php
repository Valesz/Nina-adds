<?php

namespace Application\Model\DAO\Interface;

/**
 * A base DAO
 * 
 * @method mysqli getConnection() - Return a mysqli connection.
 * @method array getAll() - Return an array of Objects from the database.
 * @method object getRow($key) - Return an object from the database with the given key.
 * @method bool save(Object $object) - Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
 * @method bool remove($key) - Attempts to remove the object with the given key from the database.
 */
interface IBaseDAO {

    /**
     * Inicializes the properties for the connection from the application.properties.json.
     */
    public function __construct();

    /**
     *  Return a mysqli connection.
     *  @return \mysqli - The connection to the database.
     */
    public function getConnection();

    /**
     * Return an array of Objects from the database.
     * @return array - Objects from the databse.
     */
    public function getAll(): array;

    /**
     * Return an object from the database with the given key.
     * @return object - An object from the database with the given key.
     */
    public function getRow($key): object;

    /**
     * Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
     * @return bool - True if successful, False if not.
     */
    public function save(Object $object): bool;

    /**
     * Attempts to remove the object with the given key from the database.
     * @return bool - True if successful, False if not.
     */
    public function remove($key): bool;
}