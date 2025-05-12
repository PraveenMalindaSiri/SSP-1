<?php
require_once APP_PATH . 'model/User.php';

class Customer extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    public function viewMyOrders()
    {
        return true;
    }

    public function addToWishlist()
    {
        return true;
    }

    public function addToCart()
    {
        return true;
    }
}
