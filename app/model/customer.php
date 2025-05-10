<?php

class Customer extends User
{
    public function __construct($fullname, $username, $email, $password, $phone, $dob, $role)
    {
        parent::__construct($fullname, $username, $email, $password, $phone, $dob, $role);
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
