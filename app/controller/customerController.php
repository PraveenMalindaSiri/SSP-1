<?php
require_once APP_PATH . 'core/Validator.php';
require_once APP_PATH . 'core/Session.php';
require_once APP_PATH . 'model/Product.php';
require_once APP_PATH . 'model/Customer.php';

class CustomerController
{
    public function customerSelection()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // setting the default amount as 1 
            if (!isset($_POST['amount']) || $_POST['amount'] === '') {
                $_POST['amount'] = 1;
            }

            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $action = $_POST['action'];

            if ($action === "wishlist") {
                $errors = Validator::validateProductDetailsFormWishlist();
            } elseif ($action === "cart") {
                $errors = Validator::validateProductDetailsFormCart();
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /cb008920/public/productview?pid=" . $_POST['pid']);
                exit;
            }

            $customer = new Customer();

            if ($action === "cart") {
                $cartAdding = $customer->addToCart($_POST['pid'], $_POST['amount'], $_SESSION['user']['username']);
                if ($cartAdding) {
                    header("Location: /cb008920/public/cart");
                } else {
                    $_SESSION['errors'] = ['cart' => 'Product did not add to Cart successfully. Please try again'];
                }
            } elseif ($action === "wishlist") {
                $wishlistAdding = $customer->addToWishlist($_POST['pid'], $_POST['amount'], $_SESSION['user']['username']);
                if ($wishlistAdding) {
                    header("Location: /cb008920/public/wishlist");
                } else {
                    $_SESSION['errors'] = ['wishlist' => 'Product did not add add to Wishlist successfully. Please try again'];
                }
            }
        }
    }

    public function showWishlistItems()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }
        $products = [];

        $customer = new Customer();

        $products = $customer->viewWishlist($_SESSION['user']['username']);

        require_once APP_PATH . 'views/customer/wishlist.php';
    }

    public function wishlistSelection()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $action = $_POST['action'];

            $customer = new Customer();

            if ($action === "remove") {
                $errors = Validator::hasPID();
            } elseif ($action === "cart") {
                $errors = Validator::isAddingDigitalItemsToCart();
            } else {
                $errors = [];
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /cb008920/public/wishlist");
                exit;
            }

            if ($action === "remove") {
                $cartDelete = $customer->deleteWishlistItem($_SESSION['user']['username'], $_POST['pid']);
                if ($cartDelete) {
                    header("Location: /cb008920/public/physicalproducts");
                } else {
                    $_SESSION['errors'] = ['delete' => 'Product did not delete from Wishlist successfully. Please try again'];
                }
            } elseif ($action === "cart") {
                $cartAdding = $customer->addToCart($_POST['pid'], $_POST['amount'], $_SESSION['user']['username']);
                if ($cartAdding) {
                    header("Location: /cb008920/public/cart");
                } else {
                    $_SESSION['errors'] = ['cart' => 'Product did not add to Cart successfully. Please try again'];
                }
            }
        }
    }

    public function showCartItems()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }

        $products = [];

        $customer = new Customer();

        $products = $customer->viewCart($_SESSION['user']['username']);

        require_once APP_PATH . 'views/customer/cart.php';
    }

    public function cartSelection()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::hasPID();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /cb008920/public/cart");
                exit;
            }

            $customer = new Customer();

            $result = $customer->deleteCartItem($_SESSION['user']['username'], $_POST['pid']);

            if ($result) {
                header("Location: /cb008920/public/physicalproducts");
            } else {
                $_SESSION['errors'] = ['delete' => 'Product did not delete from Cart successfully. Please try again'];
            }
        }
    }

    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateCartCheckout();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /cb008920/public/cart");
                exit;
            }

            $customer = new Customer();

            $result = $customer->checkout($_POST['totalprice'], $_SESSION['user']['username']);

            if ($result) {
                header("Location: /cb008920/public/checkout");
            } else {
                $_SESSION['errors'] = ['checkout' => 'Checking Out is unsuccessful. Please try again'];
            }
        } else {
            require_once APP_PATH . 'views/customer/cart.php';
        }
    }

    public function payment()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateCheckoutForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/checkout");
                exit;
            }

            $username = $_SESSION['user']['username'];

            $customer = new Customer();
            $result = $customer->payment($username, $_SESSION['cart_total'][$username]);

            if ($result) {
                header("Location: /cb008920/public/thank");
            } else {
                $_SESSION['errors'] = ['payment' => 'Payment failed. Please try again.'];
                header("Location: /cb008920/public/cart");
                exit;
            }
        } else {
            require_once APP_PATH . 'views/customer/checkouts.php';
        }
    }

    public function thank()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isCustomer()) {
            header("Location: /cb008920/public/home");
            exit;
        }

        $_POST = Validator::sanitize($_POST);
        Validator::$inputs = $_POST;

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: /cb008920/public/cart");
            exit;
        }

        $customer = new Customer();

        $result = 0;

        if ($result) {
            header("Location: /cb008920/public/checkout");
        } else {
            $_SESSION['errors'] = ['delete' => 'Product did not delete from Cart successfully. Please try again'];
        }
    }
}
