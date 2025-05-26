<?php
require_once APP_PATH . 'model/User.php';
require_once APP_PATH . 'model/Product.php';

class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getUsers()
    {
        $db = new Database();
        return $db->getAllUsers();
    }

    public function updateUsersDetails($data = [])
    {
        $user = new User();
        $user->loadFromArray($data);
        $user->setUsername($data['username']);
        return  $user->updateProfile();
    }
    public function updateUsersPassword($data = [])
    {
        $user = new User();
        $user->loadFromArray($data);
        $user->setUsername($data['username']);
        return $user->updatePassword( $data['nPassword']);
    }
    public function deleteUsers($user)
    {
        $db = new Database();
        return $db->removeUser($user);
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
        $db = new Database();
        return $db->getAllOrders();
    }

    public function viewOrderDetails($orderID)
    {
        $customer = new Customer();
        return $customer->viewMyOrderDetails($orderID);
    }

    public function addFeaturingProduct($pid){
        $db = new Database();
        return $db->addFeaturingProduct($pid);
    }

    public function removeFeaturingProduct($pid){
        $db = new Database();
        return $db->removeFeaturingProduct($pid);
    }
}
