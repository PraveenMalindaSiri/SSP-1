<?php
require_once APP_PATH . 'model/Product.php';

class User
{
    private $fullname;
    private $username;
    private $email;
    private $password;
    private $address;
    private $dob;
    private $role;

    public function __construct() {}

    public function loadFromArray($data = [])
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    public function viewHome(){
        $db = new Database();
        $pids = $db->allFeaturingProducts();

        $products  = [];

        foreach($pids as $pid){
            $product = $db->getProductById($pid);
            $products[] = $product;
        }

        return $products;
    }

    public function register()
    {
        require_once APP_PATH . 'core/Database.php';
        $db = new Database();
        return $db->insertUser([
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'dob' => $this->dob,
            'role' => $this->role,
            'address' => $this->address
        ]);
    }

    public function login($username, $password)
    {
        require_once APP_PATH . 'core/Database.php';
        $db = new Database();
        $user = $db->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            require_once APP_PATH . 'core/Session.php';
            $session = new Session();
            $session->start();
            $session->unsetUser();
            $age = $this->currentAge();
            $session->setUser($username, $user['role'], $age);
            return true;
        } else {
            return false;
        }
    }

    public function currentAge()
    {
        $dob = new DateTime($this->dob);
        $now = new DateTime();
        return $now->diff($dob)->y;
    }

    public function logout()
    {
        require_once APP_PATH . 'core/Session.php';
        $session = new Session();
        if ($session->isLoggedIn()) {
            $session->start();
            $session->unsetCart($_SESSION['user']['username']);
            $session->unsetUser();
            return true;
        } else {
            return false;
        }
    }

    public function updateProfile()
    {
        require_once APP_PATH . 'core/Database.php';
        $db = new Database();

        return $db->updateUser([
            'fullname' => $this->fullname,
            'email' => $this->email,
            'address' => $this->address,
            'username' => $this->username
        ]);
    }

    public function updatePassword($currentPassword, $newPassword)
    {
        require_once APP_PATH . 'core/Database.php';
        $db = new Database();

        $newPasswordHashed = password_hash($newPassword, PASSWORD_BCRYPT);
        return $db->updatePassword($this->username, $newPasswordHashed);
    }

    public function uploadPicture($pic, $uploadPath)
    {
        return move_uploaded_file($pic['tmp_name'], $uploadPath);
    }

    public function viewProducts()
    {
        $product = new Product();
        return $product;
    }

    public function viewProductDetails($productID)
    {
        $product = new Product();
        return $product->showProductDetails($productID);
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
        $this->password = password_hash($password, PASSWORD_BCRYPT);
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
}
