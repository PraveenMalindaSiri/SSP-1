<?php
require_once APP_PATH . 'model/User.php';
require_once APP_PATH . 'model/Product.php';

class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
    }


    public function updateUsersDetails()
    {
        return true;
    }
    public function updateUsersPassword()
    {
        return true;
    }
    public function deleteUsers()
    {
        return true;
    }

    public function getProducts()
    {
        $product = new Product();
        return $product->getAllProducts();
    }

    public function updateProducts($data)
    {
        $product = new Product();
        $product->loadFromArray($data);
        return $product;
    }

    public function deleteProducts()
    {
        $product = new Product();
        return $product;
    }

    public function viewUsersOrders()
    {
        return true;
    }
}
