<?php
require_once APP_PATH . 'core/Validator.php';
require_once APP_PATH . 'core/Session.php';
require_once APP_PATH . 'model/Product.php';
require_once APP_PATH . 'model/Seller.php';
require_once APP_PATH . 'model/Admin.php';


class ProductController
{
    public function createProduct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        if (!$session->isSeller()) {
            header("Location: /cb008920/public/home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateCreateProductForm();
            $errors = array_merge($errors, Validator::validateProductImage($_FILES['productImage']));

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/createproduct");
                exit;
            }

            $seller = new Seller();

            $product = $seller->createProducts($_POST);


            $edition = strtolower($_POST['edition']);

            if ($edition != "physical" && $edition != "digital") {
                $_SESSION['errors'] = ['edition' => 'Edition must be either physical or digital.'];
                header("Location: /cb008920/public/createproduct");
                exit;
            }

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/cb008920/public/assets/images/products/$edition/";
            $webPathPrefix = "assets/images/products/$edition/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $pic = $_FILES['productImage'];
            $extension = pathinfo($pic['name'], PATHINFO_EXTENSION);
            $productName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $_POST['name']));
            $filename = $productName . '.' . $extension;

            $uploadPath = $uploadDir . $filename;

            if (!move_uploaded_file($pic['tmp_name'], $uploadPath)) {
                $_SESSION['errors'] = ['productImage' => 'Failed to upload image.'];
                header("Location: /cb008920/public/createproduct");
                exit;
            }

            $product->setImage($webPathPrefix . $filename);

            $result = $product->create();
            if ($result) {
                // Product creation successful
                $_SESSION['success'] = ['productcreate' => 'Product created successfully.'];
                header("Location: /cb008920/public/manageproducts");
            } else {
                // Product creation failed
                $_SESSION['errors'] = ['productcreate' => 'Product creation failed. Please try again.'];
            }
        } else {
            // If not a POST request, show the create product form
            require_once APP_PATH . 'views/shared/createproduct.php';
        }
    }

    public function getAllProducts()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $session = new Session();
        $products = [];

        if (!$session->isAdmin() && !$session->isSeller()) {
            header("Location: /cb008920/public");
            exit;
        }

        if ($session->isAdmin()) {
            $admin = new Admin();
            $products = $admin->getProducts();
        } elseif ($session->isSeller()) {
            $seller = new Seller();
            $products = $seller->getMyProducts();
        }


        require_once APP_PATH . 'views/shared/manageproducts.php';
    }

    public function updateProducts()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // if (empty($_POST)) {
        //     header("Location: /cb008920/public/manageprofile");
        //     exit();
        // }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateUpdateProductsForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/updateproduct?id=" . $_POST['pid']);
                exit;
            }

            $session = new Session();
            if (!$session->isAdmin() && !$session->isSeller()) {
                header("Location: /cb008920/public");
                exit;
            }

            if ($session->isAdmin()) {
                $admin = new Admin();
                $product = $admin->updateProducts($_POST);
                $result = $product->update($_POST['pid']);
            } elseif ($session->isSeller()) {
                $seller = new Seller();
                $product = $seller->updateProducts($_POST);
                $result = $product->update($_POST['pid']);
            }

            if ($result) {
                // Product creation successful
                $_SESSION['success'] = ['productupdate' => 'Product updated successfully.'];
                header("Location: /cb008920/public/updateproduct?id=" . $_POST['pid']);
                exit;
            } else {
                // Product creation failed
                $_SESSION['errors'] = ['productupdate' => 'Product updating failed. Please try again.'];
                header("Location: /cb008920/public/updateproduct?id=" . $_POST['pid']);
            }
        } else {
            // If not a POST request, show the create product form
            require_once APP_PATH . 'views/shared/updateproduct.php';
        }
    }

    public function deleteProducts()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateUpdateProductsForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/deleteproduct?id=" . $_POST['pid']);
                exit;
            }
            $session = new Session();
            if (!$session->isAdmin() && !$session->isSeller()) {
                header("Location: /cb008920/public");
                exit;
            }

            if ($session->isAdmin()) {
                $admin = new Admin();
                $product = $admin->deleteProducts();
                $result = $product->delete($_POST['pid']);
            } elseif ($session->isSeller()) {
                $seller = new Seller();
                $product = $seller->deleteProducts();
                $result = $product->delete($_POST['pid']);
            }

            if ($result) {
                // Product creation successful
                header("Location: /cb008920/public/manageproducts");
                exit;
            } else {
                // Product creation failed
                $_SESSION['errors'] = ['productdelete' => 'Product deleting failed. Please try again.'];
                header("Location: /cb008920/public/deleteproduct?id=" . $_POST['pid']);
            }
        } else {
            // If not a POST request, show the create product form
            require_once APP_PATH . 'views/shared/deleteproduct.php';
        }
    }

    public function showProducts()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $products = [];

        $user = new User();
        $product = $user->viewProducts();

        $products = $product->showProducts();


        // get url and check if it has physicalproducts or digitalproducts in it
        $currentPage = $_SERVER['REQUEST_URI'];

        if (strpos($currentPage, 'physicalproducts') !== false) {
            require_once APP_PATH . 'views/public/physicalproducts.php';
        } elseif (strpos($currentPage, 'digitalproducts') !== false) {
            require_once APP_PATH . 'views/public/digitalproducts.php';
        }
    }

    public function productDetails()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pid = $_GET['pid'];
        Validator::$inputs = ["pid" => $pid];
        $errors = Validator::hasPID();

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: /cb008920/public/physicalproducts");
            exit;
        }

        $product = [];

        $user = new User();
        $product =  $user->viewProductDetails($pid);

        require_once APP_PATH . 'views/public/productview.php';
    }
}
