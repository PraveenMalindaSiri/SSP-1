<?php
require_once APP_PATH . 'core/Validator.php';
ob_start();

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
            require_once APP_PATH . 'model/Seller.php';

            $seller = new Seller();

            $product = $seller->createProducts($_POST);


            $edition = strtolower($_POST['edition']);

            if ($edition != "physical" && $edition != "digital") {
                $_SESSION['errors'] = ['edition' => 'Edition must be either physical or digital.'];
                //header("Location: /cb008920/public/createproduct");
                exit;
            }

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/cb008920/public/assets/images/products/$edition/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            if (!is_writable($uploadDir)) {
                $_SESSION['errors'] = ['productImage' => 'Upload folder is not writable.'];
                exit;
            }

            $webPathPrefix = "assets/images/products/$edition/";

            $pic = $_FILES['productImage'];
            $extension = pathinfo($pic['name'], PATHINFO_EXTENSION);
            $productName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $_POST['name']));
            $filename = $productName . '.' . $extension;

            $uploadPath = $uploadDir . $filename;

            if (!move_uploaded_file($pic['tmp_name'], $uploadPath)) {
                $_SESSION['errors'] = ['productImage' => 'Failed to upload image.'];
                //header("Location: /cb008920/public/createproduct");
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
