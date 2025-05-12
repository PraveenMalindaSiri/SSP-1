<?php
require_once APP_PATH . 'model/User.php';

class Customer extends User
{
    public function __construct($fullname, $username, $email, $password, $dob, $role, $address)
    {
        parent::__construct($fullname, $username, $email, $password, $dob, $role, $address);
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
