<?php

require_once APP_PATH . 'core/Database.php';

class Validator{

    public static $inputs = [];

    public static function hasValue(){
        $errors = [];

        foreach(self::$inputs as $key => $value){
            if(empty($value)){
                $errors[$key] = $key . " is required.";
            }
        }

        return $errors;
    }

    public static function hasRole(){
        $errors = [];

        if(!isset(self::$inputs['role'])){
            $errors['role'] = "Role is required.";
        }else{
            if(self::$inputs['role'] != 'customer' && self::$inputs['role'] != 'seller'){
                $errors['role'] = "Invalid role.";
            }
        }

        return $errors;
    }

    public static function isEmail(){
        $errors = [];

        if(self::$inputs['email']){
            if(!filter_var(self::$inputs['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Invalid email format.";
            }

        }

        return $errors;
    }

    public static function validPassword(){
        $errors = [];

        if(self::$inputs['password']){
            if(strlen(self::$inputs['password']) < 8){
                $errors['password'] = "Password must be at least 8 characters.";
            }
            // if(!preg_match('/[A-Z]/', self::$inputs['password'])){
            //     $errors['password'] = "Password must contain at least one uppercase letter.";
            // }
            // if(!preg_match('/[a-z]/', self::$inputs['password'])){
            //     $errors['password'] = "Password must contain at least one lowercase letter.";
            // }
            // if(!preg_match('/[0-9]/', self::$inputs['password'])){
            //     $errors['password'] = "Password must contain at least one number.";
            // }
        }

        return $errors;
    }

    public static function validPersonalInfo(){
        $errors = [];

        if(self::$inputs['fullname']){
            if(strlen(self::$inputs['fullname']) < 3){
                $errors['fullname'] = "Fullname must be at least 3 characters.";
            }
            if(strlen(self::$inputs['fullname']) > 50){
                $errors['fullname'] = "Fullname must be less than 50 characters.";
            }
            if(!preg_match("/^[a-zA-Z ]*$/", self::$inputs['fullname'])){
                $errors['fullname'] = "Only letters and white space allowed in fullname.";
            }
        }

        if(self::$inputs['address']){
            if(strlen(self::$inputs['address']) < 5){
                $errors['address'] = "Address must be at least 5 characters.";
            }
            if(strlen(self::$inputs['address']) > 255){
                $errors['address'] = "Address must be less than 255 characters.";
            }
            if(!preg_match("/^[a-zA-Z0-9, ]*$/", self::$inputs['address'])){
                $errors['address'] = "Only letters, numbers, commas and white space allowed in address.";
            }
        }

        return $errors;
    }

    public static function isUnique(){
        $errors = [];

        $username = self::$inputs['username'];
        $email = self::$inputs['email'];
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            $errors['username'] = "Username already exists.";
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            $errors['email'] = "Email already exists.";
        }

        return $errors;
    }

    public static function validateRegisterForm(){
        return array_merge_recursive(
            self::hasValue(),
            self::isEmail(),
            self::validPassword(),
            self::validPersonalInfo(),
            self::hasRole(),
            self::isUnique()
        );
    }

    public static function sanitize($data = [])
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            $sanitizedData[$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        return $sanitizedData;
    }
}