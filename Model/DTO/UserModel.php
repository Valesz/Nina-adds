<?php

namespace Application\Model\DTO;

/**
 * The PHP representation of a row in the users table.
 * 
 * @method int getId() - Return the id property of the Model.
 * @method int getName() - Return the name property of the Model.
 * @method UserModel setId(int $value) - Sets the id property of the Model, and returns it back for chain using the set functions.
 * @method UserModel setName(string $value) - Sets the name property of the Model, and returns it back for chain using the set functions.
 */
class UserModel {
    
    /**
     * PHP representation of the id row.
     */
    public int $id;
    
    /**
     * PHP representation of the name row.
     */
    public string $name;

    /**
     * Set's the values for the properties.
     */
    public function __construct(int $id = -1, string $name = "") {
        $this->id = $id;
        $this->$name = $name;
    }

    /**
     * Return the id property of the Model.
     * @return int - The id property of the Model.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Sets the id property of the Model, and returns it back for chain using the set functions.
     * @return UserModel - The Model after setting the property.
     */
    public function setId(int $value): UserModel {
        $this->id = $value;
        return $this;
    }

    /**
     * Return the name property of the Model.
     * @return string - The name property of the Model.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * setTitle(string $value) - Sets the name property of the Model, and returns it back for chain using the set functions.
     * @return UserModel - The Model after setting the property.
     */
    public function setName(string $value): UserModel {
        $this->name = htmlspecialchars($value);
        return $this;
    }
}