<?php

class Product
{
    private $name;
    private $type;
    private $genre;
    private $duration;
    private $platform;
    private $price;
    private $releaseDate;
    private $age;
    private $size;
    private $image;
    private $description;

    public function __construct($name, $type, $genre, $duration, $platform, $price, $releaseDate, $age, $size, $image, $description)
    {
        $this->name = $name;
        $this->type = $type;
        $this->genre = $genre;
        $this->duration = $duration;
        $this->platform = $platform;
        $this->price = $price;
        $this->releaseDate = $releaseDate;
        $this->age = $age;
        $this->size = $size;
        $this->image = $image;
        $this->description = $description;

    }

    public function getName()
    {
        return $this->name;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function getPlatform()
    {
        return $this->platform;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    public function setSize($size)
    {
        $this->size = $size;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function productCreate()
    {
        return true;
    }
    public function productUpdate()
    {
        return true;
    }
    public function productDelete()
    {
        return true;
    }
}