<?php

abstract class User
{
    private $fullname;
    private $username;
    private $email;
    private $password;
    private $phone;
    private $dob;
    private $role;

    public function __construct($fullname, $username, $email, $password, $phone, $dob, $role)
    {
        $this->fullname = $fullname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->dob = $dob;
        $this->role = $role;
    }

    public function register()
    {
        return true;
    }

    public function login()
    {
        return true;
    }

    public function logout()
    {
        return true;
    }

    public function updateProfile()
    {
        return true;
    }

    public function updatePassword()
    {
        return true;
    }

    public function uploadPicture()
    {
        return true;
    }

    // setters
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setDob($dob)
    {
        $this->dob = $dob;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    // Getters
    public function getFullname()
    {
        return $this->fullname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getDob()
    {
        return $this->dob;
    }
    public function getRole()
    {
        return $this->role;
    }
}
