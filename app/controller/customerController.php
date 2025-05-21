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
            if (!isset($_POST['amount']) || $_POST['amount'] === '') {
                $_POST['amount'] = 1;
            }
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateProductDetailsForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /cb008920/public/productview?pid=" . $_POST['pid']);
                exit;
            }

            var_dump($_POST);

            $customer = new Customer();
            $action = $_POST['action'];

            if ($action === "cart") {
                $result = $customer->addToCart();
            } elseif ($action === "wishlist") {
                $result = $customer->addToWishlist($_POST['pid'], $_POST['amount'], $_SESSION['user']['username']);
            }

            if ($result) {
                echo '';
                header("Location: /cb008920/public/wishlist");
            } else {
                $_SESSION['errors'] = ['wishlist' => 'Product did not add successfully. Please try again'];
            }
        }
    }
}
