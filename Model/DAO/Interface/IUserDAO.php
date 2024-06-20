<?php

namespace Application\Model\DAO\Interface;
use Application\Model\DAO\Interface\IBaseDAO;
use Application\Model\DTO\UserModel;

/**
 * Interface to use for the AdvertisementDAO.
 * It communicates with the database and constructs Data objects.
 * 
 * @method array getAll() - Return an array of UserModels from the database.
 * @method UserModel getRow(int $key) - Return an object of UserModel from the database with the given key.
 * @method bool save(UserModel $object) - Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
 * @method bool remove(int $key) - Attempts to remove the object with the given key from the database.
 */
interface IUserDAO extends IBaseDAO {

    /**
     * Return an array of UserModels from the database.
     * @return array - The users present in the database as an array of UserModels.
     */
    public function getAll() : array;

    /**
     * Return an object of UserModel from the database with the given key.
     * @return UserModel - an UserModel from the database with the given key.
     */
    public function getRow($key) : UserModel;

    /**
     * Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
     * @return bool - True if it did anything, False if not.
     */
    public function save($object): bool;

    /**
     * Attempts to remove the object with the given key from the database.
     * @return bool - True if it did anything, False if not.
     */
    public function remove($key): bool;

}