<?php

namespace Application\Model\DAO\Interface;
use Application\Model\DAO\Interface\IBaseDAO;
use Application\Model\DTO\AdvertisementModel;

/**
 * Interface to use for the AdvertisementDAO.
 * It communicates with the database and constructs Data objects.
 * 
 * @method array getAll() - Return an array of AdvertisementModels from the database.
 * @method array getAllWithNames() - Return an array of "add" => AdvertisementModel, "user" => UserModel.
 * @method AdvertisementModel getRow(int $key) - Return an object of AdvertisementModel from the database with the given key.
 * @method bool save(AdvertisementModel $object) - Attempts to save the given object. It updates the data if the object with key is present and inserts it if not.
 * @method bool remove(int $key) - Attempts to remove the object with the given key from the database.
 */
interface IAdvertisementDAO extends IBaseDAO {

    /**
     * Return an array of AdvertisementModels from the database.
     * @return array - The advertisements present in the database as an array of AdvertisementModels.
     */
    public function getAll() : array;

    /**
     * Return an array of "add" => AdvertisementModel, "user" => UserModel.
     * @return array - an array of "add" => AdvertisementModel, "user" => UserModel from the database.
     */
    public function getAllWithNames(): array;

    /**
     * Return an object of AdvertisementModel from the database with the given key.
     * @return AdvertisementModel - an AdvertisementModel from the database with the given key.
     */
    public function getRow($key) : AdvertisementModel;

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