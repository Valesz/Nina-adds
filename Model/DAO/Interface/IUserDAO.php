<?php

namespace Application\Model\DAO\Interface;
use Application\Model\DAO\Interface\IBaseDAO;
use Application\Model\DTO\UserModel;

interface IUserDAO extends IBaseDAO {

    public function getAll() : array;

    public function getRow($key) : UserModel;

    public function save($object): bool;

    public function remove($key): bool;

}