<?php
require_once APP_PATH . 'core/Database.php';

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
            $setter = 'set' . ucfirst(string: $key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    public function create()
    {
        $db = new Database();
        return $db->insertProduct([
            'name' => $this->name,
            'edition' => strtolower($this->edition),
            'genre' => strtolower($this->genre),
            'duration' => $this->duration,
            'platform' => strtolower($this->platform),
            'price' => $this->price,
            'released_date' => $this->releaseDate,
            'age_rating' => $this->age,
            'size' => $this->size,
            'img_path' => $this->image,
            'description' => $this->description,
            'company' => $_SESSION['user']['username']
        ]);
    }
    public function update($pid)
    {
        $db = new Database();
        return $db->updateProduct(
            [
                'pid' => $pid,
                'name' => $this->name,
                'genre' => strtolower($this->genre),
                'duration' => $this->duration,
                'platform' => strtolower($this->platform),
                'price' => $this->price,
                'released_date' => $this->releaseDate,
                'age_rating' => $this->age,
                'size' => $this->size,
                'description' => $this->description,
            ]
        );
    }
    public function delete($pid) {
        $db = new Database();
        return $db->deleteProduct($pid);
    }

    public function getAllProducts()
    {
        $db = new Database();
        $products = $db->getProducts();

        foreach($products as $product => $values){
            $amount = $db->getTotalProductOrders($values['pid']);
            $products[$product]['amount'] = $amount;
        }

        return $products;
    }

    public function getProductsByOwner()
    {
        $db = new Database();
        $products = $db->getProductsBySeller($this->company);
        
        foreach($products as $product => $values){
            $amount = $db->getTotalProductOrders($values['pid']);
            $products[$product]['amount'] = $amount;
        }

        return $products;
    }

    public function showProducts(){
        $db = new Database();
        return $db->getProducts();
    }

    public function showProductDetails($productID){
        $db = new Database();
        return $db->getProductById($productID);
    }

    // getters and setters
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
