<?php

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $dob = $_POST['dob'];
            $role = $_POST['role'];

            if ($role == 'seller') {
                require_once APP_PATH . 'model/seller.php';
                $user = new Seller($fullname, $username, $email, $password,$dob, $role, $address);
            } elseif ($role == 'customer') {
                require_once APP_PATH . 'model/customer.php';
                $user = new Customer($fullname, $username, $email, $password, $dob, $role, $address);
            }
            else {
                // Handle invalid role
                echo "Invalid role selected.";
                return;
            }

            $result = $user->register();

            if ($result) {
                // Registration successful
                echo "Registration successful!";
            } else {
                // Registration failed
                echo "Registration failed. Please try again.";
            }
        } else {
            // If not a POST request, show the registration form
            require_once APP_PATH . 'views/public/register.php';
        }
    }

    public function login()
    {
        // Handle user login logic here
        echo "User login logic goes here.";
    }
}
