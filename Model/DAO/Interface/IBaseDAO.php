<?php

namespace Application\Model\DAO\Interface;

interface IBaseDAO {

    public function __construct();

    public function getConnection();

    public function getAll(): array;

    public function getRow($key);
}