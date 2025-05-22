<?php
require_once APP_PATH . 'model/User.php';
require_once APP_PATH . 'core/Database.php';
require_once APP_PATH . 'core/Session.php';

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

    public function addToCart($pid, $amount, $user)
    {
        $session = new Session();

        return $session->setCartItems($pid, $amount, $user);
    }

    public function viewWishlist($username)
    {
        $db = new Database();
        return $db->getWishlistItems($username);
    }

    public function viewCart($username)
    {
        $cartItems = [];
        $db = new Database();

        foreach ($_SESSION['cart'][$username] as $pid => $amount) {
            // iterate through each key,value in cart and get p details and add the relevant amount to details
            $product = $db->getProductById($pid);
            if ($product) {
                $product['amount'] = $amount;
                $cartItems[] = $product;
            }
        }

        return $cartItems;
    }

    public function deleteWishlistItem($username, $pid)
    {
        $db = new Database();
        return $db->deleteWishlistItems($username, $pid);
    }

    public function deleteCartItem($username, $pid) {
        $session = new Session();
        return $session->unsetCartItem($username, $pid);
    }
}
