<?php 

namespace Application\Model\DTO;

class AdvertisementModel {
    private int $id;
    private int $userId;
    private string $title;

    public function __construct(int $id = -1, int $userId = -1, string $title = "") {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $value) : AdvertisementModel {
        $this->id = $value;
        return $this;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $value): AdvertisementModel {
        $this->userId = $value;
        return $this;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle($value): AdvertisementModel {
        $this->title = $value;
        return $this;
    }
}