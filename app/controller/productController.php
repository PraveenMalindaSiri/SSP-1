<?php
require_once APP_PATH . 'core/Validator.php';

class ProductController
{
    public function createProduct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
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

            require_once APP_PATH . 'model/Product.php';

            $product = new Product();
            $product->loadFromArray($_POST);
            $product->setCompany($_SESSION['user']['username']);
            

            $edition = strtolower($_POST['edition']);

            if ($edition != "physical" && $edition != "digital") {
                $_SESSION['errors'] = ['edition' => 'Edition must be either physical or digital.'];
                header("Location: /cb008920/public/createproduct");
                exit;
            }

            $uploadDir = APP_PATH . "public/assets/images/products/$edition/";
            $webPathPrefix = "assets/images/products/$edition/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $pic = $_FILES['productImage'];
            $extension = pathinfo($pic['name'], PATHINFO_EXTENSION);
            $filename = uniqid('product_', true) . '.' . $extension;
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
}
