<?php

require_once APP_PATH . 'core/Database.php';

class Validator
{

    public static $inputs = [];

    public static function hasValue()
    {
        $errors = [];

        foreach (self::$inputs as $key => $value) {
            if (empty($value)) {
                $errors[$key] = $key . " is required.";
            }
        }

        return $errors;
    }

    public static function matchingPassword()
    {
        $errors = [];

        if (self::$inputs['nPassword'] != self::$inputs['conPassword']) {
            $errors['Passwords'] = "New and Confirm Passwords do not match.";
        }

        return $errors;
    }

    public static function hasRole()
    {
        $errors = [];

        if (!isset(self::$inputs['role'])) {
            $errors['role'] = "Role is required.";
        } else {
            if (self::$inputs['role'] != 'customer' && self::$inputs['role'] != 'seller') {
                $errors['role'] = "Invalid role.";
            }
        }

        return $errors;
    }

    public static function isEmail()
    {
        $errors = [];

        if (self::$inputs['email']) {
            if (!filter_var(self::$inputs['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
        }

        return $errors;
    }

    public static function validPassword($namePassword = 'password')
    {
        $errors = [];

        if (self::$inputs[$namePassword]) {
            if (strlen(self::$inputs[$namePassword]) < 8) {
                $errors[$namePassword] = "Password must be at least 8 characters.";
            }
            // if(!preg_match('/[A-Z]/', self::$inputs[$namePassword])){
            //     $errors[$namePassword] = "Password must contain at least one uppercase letter.";
            // }
            // if(!preg_match('/[a-z]/', self::$inputs[$namePassword])){
            //     $errors[$namePassword] = "Password must contain at least one lowercase letter.";
            // }
            // if(!preg_match('/[0-9]/', self::$inputs[$namePassword])){
            //     $errors[$namePassword] = "Password must contain at least one number.";
            // }
        }

        return $errors;
    }

    public static function validPersonalInfo()
    {
        $errors = [];

        if (self::$inputs['fullname']) {
            if (strlen(self::$inputs['fullname']) < 3) {
                $errors['fullname'] = "Fullname must be at least 3 characters.";
            }
            if (strlen(self::$inputs['fullname']) > 50) {
                $errors['fullname'] = "Fullname must be less than 50 characters.";
            }
            if (!preg_match("/^[a-zA-Z ]*$/", self::$inputs['fullname'])) {
                $errors['fullname'] = "Only letters and white space allowed in fullname.";
            }
        }

        if (self::$inputs['address']) {
            if (strlen(self::$inputs['address']) < 5) {
                $errors['address'] = "Address must be at least 5 characters.";
            }
            if (strlen(self::$inputs['address']) > 255) {
                $errors['address'] = "Address must be less than 255 characters.";
            }
            if (!preg_match("/^[a-zA-Z0-9, ]*$/", self::$inputs['address'])) {
                $errors['address'] = "Only letters, numbers, commas and white space allowed in address.";
            }
        }

        return $errors;
    }

    public static function isUniqueUsername()
    {
        $errors = [];

        $username = self::$inputs['username'];
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors['username'] = "Username already exists.";
        }

        return $errors;
    }

    public static function isUniqueEmail()
    {
        $errors = [];

        $email = self::$inputs['email'];
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors['email'] = "Email already exists.";
        }

        return $errors;
    }

    public static function isUniqueProductName()
    {
        $errors = [];

        $name = self::$inputs['name'];
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM products WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors['name'] = "Product name already exists.";
        }

        return $errors;
    }



    public static function validateRegisterForm()
    {
        return array_merge_recursive(
            self::hasValue(),
            self::isEmail(),
            self::validPassword(),
            self::validPersonalInfo(),
            self::hasRole(),
            self::isUniqueUsername(),
            self::isUniqueEmail()
        );
    }

    public static function validateLoginForm()
    {
        return  self::hasValue();
    }

    public static function sanitize($data = [])
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            $sanitizedData[$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        return $sanitizedData;
    }

    public static function validateUpdateProfileForm()
    {
        return array_merge_recursive(
            self::isEmail(),
            self::isUniqueEmail(),
            self::validPersonalInfo()
        );
    }

    public static function validateUpdatePasswordForm()
    {
        return array_merge_recursive(
            self::hasValue(),
            self::validPassword('nPassword'),
            self::validPassword('conPassword'),
            self::matchingPassword()
        );
    }

    public static function validPdctDetails()
    {
        $errors = [];

        if (self::$inputs['name']) {
            if (strlen(self::$inputs['name']) < 3) {
                $errors['name'] = "Product name must be at least 3 characters.";
            }
            if (strlen(self::$inputs['name']) > 50) {
                $errors['name'] = "Product name must be less than 50 characters.";
            }
        }

        if (self::$inputs['description']) {
            if (strlen(self::$inputs['description']) < 10) {
                $errors['description'] = "Description must be at least 10 characters.";
            }
            if (strlen(self::$inputs['description']) > 500) {
                $errors['description'] = "Description must be less than 500 characters.";
            }
        }

        return $errors;
    }

    public static function validateProductImage($pic)
    {
        $errors = [];

        if (!isset($pic['type']) || !isset($pic['size']) || !isset($pic['tmp_name'])) {
            $_SESSION['errors'] = ['productImage' => 'Upload a picture.'];
        }

        $type = explode('/', $pic['type'])[1];

        if ($type != 'jpeg' && $type != 'png') {
            $errors['productImage'] = "Invalid file type. Only JPEG and PNG are allowed.";
        }
        if ($pic['size'] > 5000000) {
            $errors['productImage'] = "File size exceeds 5MB.";
        }

        // if (chmod($pic['tmp_name'], 0766)) {
        //     $errors['productImage'] = "File permissions are not set correctly.";
        // }

        return $errors;
    }

    public static function validPlatform()
    {
        $errors = [];

        if (self::$inputs['platform']) {
            if (self::$inputs['platform'] != 'PC' && self::$inputs['platform'] != 'PS4' && self::$inputs['platform'] != 'PS5' && self::$inputs['platform'] != 'XBOX' && self::$inputs['platform'] != 'SWITCH') {
                $errors['platform'] = "Invalid platform. Select either PC, PS4, PS5, XBOX or SWITCH.";
            }
        }
        return $errors;
    }

    public static function validEdition()
    {
        $errors = [];

        if (self::$inputs['edition']) {
            if (self::$inputs['edition'] != 'Physical' && self::$inputs['edition'] != 'Digital') {
                $errors['edition'] = "Invalid edition. Select either Physical or Digital.";
            }
        }

        return $errors;
    }

    public static function validNumbers()
    {
        $errors = [];

        if (self::$inputs['price']) {
            if (!is_numeric(self::$inputs['price']) || self::$inputs['price'] < 0) {
                $errors['price'] = "Price must be a positive number.";
            }
        }

        if (self::$inputs['duration']) {
            if (!is_numeric(self::$inputs['duration']) || self::$inputs['duration'] < 0) {
                $errors['duration'] = "Duration must be positive a number.";
            }
        }
        if (self::$inputs['age']) {
            if (!is_numeric(self::$inputs['age']) || self::$inputs['age'] < 0) {
                $errors['age'] = "Age must be a positive number.";
            }
        }
        if (self::$inputs['size']) {
            if (!is_numeric(self::$inputs['size']) || self::$inputs['size'] < 0) {
                $errors['size'] = "Size must be a positive number.";
            }
        }

        return $errors;
    }

    public static function validateCreateProductForm()
    {
        return array_merge_recursive(
            self::hasValue(),
            self::isUniqueProductName(),
            self::validNumbers(),
            self::validPdctDetails(),
            self::validPlatform(),
            self::validEdition()
        );
    }
}
