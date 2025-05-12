<?php

abstract class User
{
    private $fullname;
    private $username;
    private $email;
    private $password;
    private $address;
    private $dob;
    private $role;

    public function __construct($fullname, $username, $email, $password, $dob, $role, $address)
    {
        $this->fullname = $fullname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->dob = $dob;
        $this->role = $role;
        $this->address = $address;
    }

    public function register()
    {
        require_once APP_PATH . 'core/Database.php';
        $db = new Database();
        return $db->insertUser([
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_BCRYPT),
            'dob' => $this->dob,
            'role' => $this->role,
            'address' => $this->address
        ]);
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
    public function setDob($dob)
    {
        $this->dob = $dob;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function setAddress($address)
    {
        $this->address = $address;
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

    public function getDob()
    {
        return $this->dob;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getAddress()
    {
        return $this->address;
    }
}
