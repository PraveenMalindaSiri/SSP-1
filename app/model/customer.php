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
        $db = new Database();
        return $db->getCustomerOrders($_SESSION['user']['username']);
    }

    public function viewMyOrderDetails($orderID){
        $db = new Database();
        $orderPS = $db->getOrderPS($orderID);
        $orderDetails = [];

        
        foreach ($orderPS as $OrderP) {
            $rawProduct = $db->getProductById($OrderP['pid']);
            $rawProduct['amount'] = $OrderP['amount'] ?? 1;
            $rawProduct['code'] = $OrderP['digitalcode'] ?? null;
            $rawProduct['orderid'] = $OrderP['orderid'];
            $rawProduct['is_Digital'] = $OrderP['is_digital'];

            $orderDetails[] = $rawProduct;
        }

        return $orderDetails;
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

        if (!isset($_SESSION['cart'][$username]) || !is_array($_SESSION['cart'][$username])) {
            return false;
        }

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

    public function deleteCartItem($username, $pid)
    {
        $session = new Session();
        return $session->unsetCartItem($username, $pid);
    }

    public function checkout($totalP, $user)
    {

        $session = new Session();
        return $session->setCartTotal($totalP, $user);
    }

    public function payment($user, $totalprice)
    {
        $db = new Database();
        $O_ID = $db->addOrder($user, $totalprice);

        if ($O_ID) {
            $result = $this->OrderProducts($O_ID, $user);
            $_SESSION['last_oid'] = $O_ID;
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function OrderProducts($orderID, $user)
    {
        $db = new Database();
        $pids = $_SESSION['cart'][$user];
        $list = [];
        $result = [];

        foreach ($pids as $pid => $amount) {
            $product = $db->getProductById($pid);
            if (strtolower($product['type']) === 'digital') {
                $code = $this->codeGenerator($pid, $user);
                $product['code'] = $code;
                $product['is_Digital'] = 1;
            } else {
                $product['code'] = null;
                $product['is_Digital'] = 0;
            }
            $product['amount'] = $amount;
            $product['orderID'] = $orderID;
            $list[] = $product;
        }

        foreach ($list as $item) {
            $added = $db->addOrderProduct($item);
            $result[] = $added;
        }

        if (!in_array(false, $result, true)) {
            return true;
        }

        return false;
    }

    public function codeGenerator($pid, $username)
    {
        return "$pid.$username." . time();
    }

    public function thank()
    {
        $orderID = $_SESSION['last_oid'] ?? null;
        $db = new Database();
        $orderPS = $db->getOrderPS($orderID);
        $products = [];

        foreach ($orderPS as $OrderP) {
            $rawProduct = $db->getProductById($OrderP['pid']);
            $rawProduct['amount'] = $OrderP['amount'] ?? 1;
            $rawProduct['code'] = $OrderP['digitalcode'] ?? null;
            $rawProduct['orderid'] = $OrderP['orderid'];
            $rawProduct['is_Digital'] = $OrderP['is_digital'];

            $products[] = $rawProduct;
        }

        $user = $db->getUserByUsername($_SESSION['user']['username']);
        $_SESSION['address'] = $user['address'];

        return $products;
    }
}
