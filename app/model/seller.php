<?php
require_once APP_PATH . 'model/User.php';

class Seller extends User
{
    public function __construct($fullname, $username, $email, $password, $dob, $role, $address)
    {
        parent::__construct($fullname, $username, $email, $password, $dob, $role, $address);
    }

    public function createProducts()
    {
        return true;
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