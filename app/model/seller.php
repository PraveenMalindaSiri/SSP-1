<?php
require_once APP_PATH . 'model/User.php';

class Seller extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createProducts($data)
    {
        require_once APP_PATH . 'model/Product.php';
        $product = new Product();
        $product->loadFromArray($data);
        $product->setCompany($_SESSION['user']['username']);
        return $product;
    }

    public function updateProducts()
    {
        return true;
    }

    public function deleteProducts()
    {
        return true;
    }
}
