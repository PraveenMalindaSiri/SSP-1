<?php

class Session
{
    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function unsetUser()
    {
        unset($_SESSION['user']);
    }
    public function setUser($username, $role, $age)
    {
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $role,
            'age' => $age
        ];
    }
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
    }
    
    public function isCustomer()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'customer';
    }

    public function isSeller()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'seller';
    }
}