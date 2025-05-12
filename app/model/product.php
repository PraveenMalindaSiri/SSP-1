<?php

class Product
{
    private $name;
    private $edition;
    private $genre;
    private $duration;
    private $platform;
    private $price;
    private $releaseDate;
    private $age;
    private $size;
    private $image;
    private $description;
    private $company;

    public function __construct() {}
    public function loadFromArray($data = [])
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    public function create() {
        require_once APP_PATH . 'core/Database.php';
        $db = new Database();
        return $db->insertProduct([
            'name' => $this->name,
            'edition' => $this->edition,
            'genre' => $this->genre,
            'duration' => $this->duration,
            'platform' => $this->platform,
            'price' => $this->price,
            'releaseDate' => $this->releaseDate,
            'age_rating' => $this->age,
            'size' => $this->size,
            'image' => $this->image,
            'description' => $this->description,
            'company' => $_SESSION['user']['username']
        ]);
    }
    public function update() {}
    public function delete() {}

    public function getName()
    {
        return $this->name;
    }
    public function getEdition()
    {
        return $this->edition;
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
    public function getCompany()
    {
        return $this->company;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEdition($edition)
    {
        $this->edition = $edition;
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
    public function setCompany($company)
    {
        $this->company = $company;
    }
}
