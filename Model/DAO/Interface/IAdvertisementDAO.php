<?php

namespace Application\Model\DAO\Interface;
use Application\Model\DAO\Interface\IBaseDAO;
use Application\Model\DTO\AdvertisementModel;

interface IAdvertisementDAO extends IBaseDAO {

    public function getAll() : array;

    public function getAllWithNames();

    public function getRow($key) : AdvertisementModel;

    public function save($object): bool;
}