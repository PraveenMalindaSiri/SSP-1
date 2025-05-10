<?php

class Admin extends User
{
    public function __construct($fullname, $username, $email, $password, $phone, $dob, $role)
    {
        parent::__construct($fullname, $username, $email, $password, $phone, $dob, $role);
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