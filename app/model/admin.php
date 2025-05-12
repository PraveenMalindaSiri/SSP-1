<?php
require_once APP_PATH . 'model/User.php';

class Admin extends User
{
    public function __construct($fullname, $username, $email, $password, $dob, $role, $address)
    {
        parent::__construct($fullname, $username, $email, $password, $dob, $role, $address);
    }

    public function manageUsers()
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

    public function viewUsersOrders()
    {
        return true;
    }
}