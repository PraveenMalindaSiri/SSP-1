<?php

require_once APP_PATH . 'core/Database.php';
require_once APP_PATH . 'core/Session.php';

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
            if (self::$inputs['role'] != 'customer' && self::$inputs['role'] != 'seller' && self::$inputs['role'] != 'admin') {
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

    public static function validCurrentPassword()
    {
        $errors = [];

        if (!empty(self::$inputs['cPassword']) && !empty(self::$inputs['username'])) {
            $db = new Database();
            $user = $db->getUserByUsername(self::$inputs['username']);

            if (!$user || !isset($user['password'])) {
                $errors['cPassword'] = "User not found.";
            } elseif (!password_verify(self::$inputs['cPassword'], $user['password'])) {
                $errors['cPassword'] = "Current password is incorrect.";
            }
        } else {
            $errors['cPassword'] = "Current password is required.";
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
            self::matchingPassword(),
            self::validCurrentPassword()
        );
    }

    public static function isValidUser()
    {
        $errors = [];

        $conn = Database::getConnection();
        $statment = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $statment->bind_param('s', self::$inputs['username']);
        $statment->execute();
        $statment->store_result();
        if ($statment->num_rows === 0) {
            $errors['username'] = "Username does exists.";
        }

        return $errors;
    }

    public static function isDeletingYourself()
    {
        $errors = [];

        $conn = Database::getConnection();
        $statment = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $statment->bind_param('s', self::$inputs['username']);
        $statment->execute();
        $result = $statment->get_result();
        $user = $result->fetch_assoc();
        if (!$user) {
            $errors['username'] = "Username does exists.";
        } else {
            if ($_SESSION['user']['username'] === $user['username']) {
                $errors['username'] = "You can't delete yourself.";
            } elseif (strtolower($user['role']) === "admin") {
                $errors['username'] = "You can't delete an ADMIN.";
            }
        }

        return $errors;
    }

    public static function validateUpdateProfileFormAdmin()
    {
        return array_merge_recursive(
            self::validateUpdateProfileForm(),
            self::isValidUser()
        );
    }

    public static function validateUpdatePasswordFormAdmin()
    {
        return array_merge_recursive(
            self::validateUpdatePasswordForm(),
            self::isValidUser()
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

        if ($type != 'jpeg' && $type != 'png' && $type != 'jpg') {
            $errors['productImage'] = "Invalid file type. Only JPEG,JPG and PNG are allowed.";
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
            if (strtolower(self::$inputs['platform']) != 'pc' && strtolower(self::$inputs['platform']) != 'ps4' && strtolower(self::$inputs['platform']) != 'ps4' && strtolower(self::$inputs['platform']) != 'xbox' && strtolower(self::$inputs['platform']) != 'switch') {
                $errors['platform'] = "Invalid platform. Select either PC, PS4, PS5, XBOX or SWITCH.";
            }
        }
        return $errors;
    }

    public static function validEdition()
    {
        $errors = [];

        if (self::$inputs['edition']) {
            if (strtolower(self::$inputs['edition']) != 'physical' && strtolower(self::$inputs['edition']) != 'digital') {
                $errors['edition'] = "Invalid edition. Select either Physical or Digital.";
            }
        }

        return $errors;
    }

    public static function validGenre()
    {
        $errors = [];

        if (self::$inputs['genre']) {
            if (strtolower(self::$inputs['genre']) != 'rpg' && strtolower(self::$inputs['genre']) != 'shooter' && strtolower(self::$inputs['genre']) != 'car') {
                $errors['genre'] = "Invalid genre. Select RPG, SHOOTER or CAR.";
            }
        }

        return $errors;
    }

    public static function validNumbers()
    {
        $errors = [];

        if (trim(self::$inputs['price']) !== '') {
            if (!is_numeric(self::$inputs['price']) || self::$inputs['price'] <= 0) {
                $errors['price'] = "Price must be a positive number.";
            }
        }

        if (trim(self::$inputs['duration']) !== '') {
            if (!is_numeric(self::$inputs['duration']) || self::$inputs['duration'] <= 0) {
                $errors['duration'] = "Duration must be positive a number.";
            }
        }
        if (trim(self::$inputs['age']) !== '') {
            if (!is_numeric(self::$inputs['age']) || self::$inputs['age'] <= 0) {
                $errors['age'] = "Age must be a positive number.";
            }
        }
        if (trim(self::$inputs['size']) !== '') {
            if (!is_numeric(self::$inputs['size']) || self::$inputs['size'] <= 0) {
                $errors['size'] = "Size must be a positive number.";
            }
        }

        return $errors;
    }

    public static function hasPID()
    {
        $errors = [];

        if (!isset(self::$inputs['pid']) || !is_numeric(self::$inputs['pid'])) {
            $errors['pid'] = 'Please provide a valid Product ID';
        } else {

            $conn = Database::getConnection();

            $stmt = $conn->prepare("SELECT * FROM products WHERE pid = ?");
            $stmt->bind_param("i", self::$inputs['pid']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 0) {
                $errors['pid'] = "Product is ID wrong";
            }
        }
        return $errors;
    }

    public static function isTheProductOwner($sellerName)
    {
        $errors = [];

        $db = new Database();
        $results = $db->getProductById(self::$inputs['pid']);

        if ($results['company'] != $sellerName) {
            $errors['pid'] = "You are not the owner of this product.";
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
            self::validEdition(),
            self::validGenre()
        );
    }

    public static function validateUpdateProductsForm()
    {
        $errors = [];
        $session = new Session();
        if ($session->isSeller()) {
            $errors = array_merge_recursive($errors, self::isTheProductOwner($_SESSION['user']['username']));
        }
        return array_merge(
            $errors,
            self::hasPID(),
            self::validNumbers(),
            self::isUniqueProductName(),
            self::validPdctDetails(),
            self::validPlatform(),
            self::validGenre()
        );
    }

    public static function validateDeleteProductForm()
    {
        $errors = [];
        $session = new Session();
        if ($session->isSeller()) {
            $errors = array_merge_recursive($errors, self::isTheProductOwner($_SESSION['user']['username']));
        }
        return array_merge_recursive(
            $errors,
            self::hasPID(),
        );
    }

    public static function validAmount()
    {
        $errors = [];

        if (!isset(self::$inputs['amount']) || trim(self::$inputs['amount']) === '') {
            $errors['amount'] = "Amount is required.";
            return $errors;
        }

        $amount = (int) self::$inputs['amount'];
        $type = strtolower(trim(self::$inputs['type'] ?? ''));

        if (!is_numeric($amount) || $amount <= 0) {
            $errors['amount'] = "Amount must be positive a number.";
        }
        if ($type === 'digital' && $amount > 1) {
            $errors['amount'] = "Digital products amount cannot be higher than 1.";
        }
        return $errors;
    }

    public static function isAddingDigitalItemsToWishlist()
    {
        $errors = [];

        $type = strtolower(trim(self::$inputs['type'] ?? ''));

        if ($type === 'digital') {
            $conn = Database::getConnection();

            $stmt = $conn->prepare("SELECT * FROM wishlist WHERE pid = ? AND username = ?");
            $stmt->bind_param("is", self::$inputs['pid'], $_SESSION['user']['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $errors['pid'] = "Item already exists in Wishlist. Can't order more than 1 Digital item at a time.";
            }
        }

        return $errors;
    }

    public static function isAddingDigitalItemsToCart()
    {
        $errors = [];

        $type = strtolower(trim(self::$inputs['type'] ?? ''));
        $username = $_SESSION['user']['username'];
        $pid = self::$inputs['pid'];

        if ($type === 'digital') {

            $Currentamount = $_SESSION['cart'][$username][$pid] ?? 0;

            if ($Currentamount >= 1) {
                $errors['pid'] = "Item already exists in Cart. Can't order more than 1 Digital item at a time.";
            }
        }

        return $errors;
    }

    public static function validAge()
    {
        $errors = [];

        $userAge = (int) $_SESSION['user']['age'];
        $ageRating = (int) self::$inputs['age'];
        if ($userAge < $ageRating) {
            $errors['age'] = "Age rating does not match";
        }

        return $errors;
    }

    public static function validateProductDetailsFormWishlist()
    {
        return array_merge_recursive(
            self::hasPID(),
            self::validAmount(),
            //self::validAge(),
            self::isAddingDigitalItemsToWishlist()
        );
    }

    public static function validateProductDetailsFormCart()
    {
        return array_merge_recursive(
            self::hasPID(),
            self::validAmount(),
            //self::validAge(),
            self::isAddingDigitalItemsToCart()
        );
    }

    public static function validateCartCheckout()
    {
        $errors = [];

        if (empty(self::$inputs['totalprice']) || self::$inputs['totalprice'] == 0) {
            $errors['totalprice'] = "Total Price cannot be 0";
        }
        if (empty(self::$inputs['terms'])) {
            $errors['terms'] = "Please agree with Terms before proceed to Payments.";
        }

        return $errors;
    }

    public static function validCard()
    {
        $errors = [];

        if (self::$inputs['cname']) {
            if (strlen(self::$inputs['cname']) < 3) {
                $errors['cname'] = "Card Name must be at least 3 characters.";
            }
            if (strlen(self::$inputs['cname']) > 50) {
                $errors['cname'] = "Card Name must be less than 50 characters.";
            }
            if (!preg_match("/^[a-zA-Z ]*$/", self::$inputs['cname'])) {
                $errors['cname'] = "Only letters and white space allowed in Card Name.";
            }
        }
        if (self::$inputs['cnum']) {
            if (!ctype_digit(self::$inputs['cnum']) || strlen(self::$inputs['cnum']) < 12 || strlen(self::$inputs['cnum']) > 19) {
                $errors['cnum'] = "Card Number is not valid.";
            }
        }
        if (self::$inputs['secnum']) {
            if (!ctype_digit(self::$inputs['secnum']) || strlen(self::$inputs['secnum']) !== 3) {
                $errors['secnum'] = "Security Number is not valid.";
            }
        }

        return $errors;
    }

    public static function validateCheckoutForm()
    {
        return array_merge_recursive(
            self::hasValue(),
            self::validCard()
        );
    }

    public static function validOrderID()
    {
        $errors = [];
        $conn = Database::getConnection();

        if (!empty(self::$inputs['id'])) {
            $statment = $conn->prepare("SELECT * FROM orders WHERE orderid = ?");
            $statment->bind_param("i", self::$inputs["id"]);
            $statment->execute();
            $statment->store_result();
            if ($statment->num_rows === 0) {
                $errors['id'] = "Invalid Order ID.";
            }
        } else {
            $errors['id'] = "Order ID is required.";
        }
        return $errors;
    }

    public static function isTheOrderOwner($username)
    {
        $errors = [];
        $db = new Database();
        $order = $db->getOrderByID(self::$inputs['id'], $username);
        if ($order['username'] !== $username) {
            $errors["id"] = 'This is not your order.';
        }
        return $errors;
    }

    public static function validateOrderDetailsView()
    {
        $errors = [];
        $session = new Session();
        if ($session->isCustomer()) {
            $errors = array_merge_recursive($errors, self::isTheOrderOwner($_SESSION['user']['username']));
        }
        return array_merge_recursive(
            $errors,
            self::validOrderID(),
        );
    }

    public static function hasFeaturingPID()
    {
        $errors = [];

        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM featured_products WHERE pid = ?");
        $stmt->bind_param('i', self::$inputs['pid']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
            $errors['pid'] = "Product is not featured.";
        }

        return $errors;
    }

    public static function isFeaturingPID()
    {
        $errors = [];

        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM featured_products WHERE pid = ?");
        $stmt->bind_param('i', self::$inputs['pid']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors['pid'] = "Product is already featured.";
        }

        return $errors;
    }

    public static function validateFeatureAddForm()
    {
        return array_merge(
            self::hasPID(),
            self::isFeaturingPID()
        );
    }

    public static function validateFeatureRemoveForm()
    {
        return array_merge(
            self::hasPID(),
            self::hasFeaturingPID()
        );
    }
}
