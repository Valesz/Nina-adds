<?php

namespace Application\Model\DTO;

class UserModel {
    
    public int $id;
    
    public string $name;

    public function __construct(int $id = -1, string $name = "") {
        $this->id = $id;
        $this->$name = $name;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $value): UserModel {
        $this->id = $value;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $value): UserModel {
        $this->name = $value;
        return $this;
    }
}