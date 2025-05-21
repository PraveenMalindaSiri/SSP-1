<?php
require_once APP_PATH . 'model/User.php';
require_once APP_PATH . 'core/Database.php';

class Customer extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    public function viewMyOrders()
    {
        return true;
    }

    public function addToWishlist($pid, $amount, $user)
    {
        $db = new Database();
        return $db->AddWishlistItem($pid, $amount, $user);
    }

    public function addToCart()
    {
        return true;
    }
}
