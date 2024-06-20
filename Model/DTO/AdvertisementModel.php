<?php 

namespace Application\Model\DTO;

/**
 * The PHP representation of a row in the advertisements table.
 * 
 * @method int getId() - Return the id property of the Model.
 * @method int getUserId() - Return the userId property of the Model.
 * @method int getTitle() - Return the title property of the Model.
 * @method AdvertisementModel setId(int $value) - Sets the id property of the Model, and returns it back for chain using the set functions.
 * @method AdvertisementModel setUserId(int $value) - Sets the userId property of the Model, and returns it back for chain using the set functions.
 * @method AdvertisementModel setTitle(string $value) - Sets the title property of the Model, and returns it back for chain using the set functions.
 */
class AdvertisementModel {

    /**
     * PHP representation of the id row.
     */
    private int $id;

    /**
     * PHP representation of the userId row.
     */
    private int $userId;
    
    /**
     * PHP representation of the title row.
     */
    private string $title;

    /**
     * Set's the values for the properties.
     */
    public function __construct(int $id = -1, int $userId = -1, string $title = "") {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
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
     * @return AdvertisementModel - The Model after setting the property.
     */
    public function setId(int $value) : AdvertisementModel {
        $this->id = $value;
        return $this;
    }

    /**
     * Return the userId property of the Model.
     * @return int - The userId property of the Model.
     */
    public function getUserId(): int {
        return $this->userId;
    }

    /**
     * setUserId(int $value) - Sets the userId property of the Model, and returns it back for chain using the set functions.
     * @return AdvertisementModel - The Model after setting the property.
     */
    public function setUserId(int $value): AdvertisementModel {
        $this->userId = $value;
        return $this;
    }

    /**
     * Return the title property of the Model.
     * @return string - The title property of the Model.
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * setTitle(string $value) - Sets the title property of the Model, and returns it back for chain using the set functions.
     * @return AdvertisementModel - The Model after setting the property.
     */
    public function setTitle($value): AdvertisementModel {
        $this->title = $value;
        return $this;
    }
}