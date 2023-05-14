<?php

class Center {
    private int $id;
    private string $name;
    private string $address;
    private array $courts;

    /**
     * @param $id
     * @param $address
     * @param $courts
     */
    public function __construct($id, $name, $address, $courts)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->courts = $courts;
    }


    public function addCourt($court): void
    {
        $this->courts[] = $court;
    }

    public function initCourts($courts_list): void
    {
        foreach ($courts_list as $court) {
            $this->addCourt($court);
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return array
     */
    public function getCourts()
    {
        return $this->courts;
    }

}