<?php

require_once APP_PATH . 'core/Validator.php';
class UserController
{
    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateRegisterForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/register");
                exit('Redirecting...');
            }

            $role = $_POST['role'];

            if ($role == 'seller') {
                require_once APP_PATH . 'model/seller.php';
                $user = new Seller();
            } elseif ($role == 'customer') {
                require_once APP_PATH . 'model/customer.php';
                $user = new Customer();
            }

            $user->loadFromArray($_POST);
            $result = $user->register();

            if ($result) {
                // Registration successful
                header("Location: /cb008920/public/login");
                exit;
            } else {
                // Registration failed
                $_SESSION['errors'] = ['register' => 'Registration failed. Please try again.'];
            }
        } else {
            // If not a POST request, show the registration form
            require_once APP_PATH . 'views/public/register.php';
        }
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateLoginForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/login");
                exit;
            }

            $username = $_POST['username'];
            $password = $_POST['password'];

            require_once APP_PATH . 'model/user.php';
            $user = new User();
            $result = $user->login($username, $password);

            if ($result) {
                // Login successful
                header("Location: /cb008920/public/home");
                exit;
            } else {
                // Login failed
                $_SESSION['errors'] = ['login' => 'Invalid username or password.'];
                require_once APP_PATH . 'views/public/login.php';
            }
        } else {
            // If not a POST request, show the login form
            require_once APP_PATH . 'views/public/login.php';
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once APP_PATH . 'model/user.php';
        $user = new User();
        $result = $user->logout();
        if ($result) {
            header("Location: /cb008920/public/login");
            exit;
        } else {
            // Logout failed
            $_SESSION['errors'] = ['logout' => 'Please log in first.'];
            header("Location: /cb008920/public/login");
            exit;
        }
    }

    public function updateProfile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $noInput = empty($_POST['fullname']) && empty($_POST['email']) && empty($_POST['address']);
            if($noInput){
                header("Location: /cb008920/public/manageprofile");
                exit();
            }
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateUpdateProfileForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/manageprofile");
                exit('Redirecting...');
            }

            require_once APP_PATH . 'model/user.php';
            $user = new User();
            $user->loadFromArray($_POST);
            $user->setUsername($_SESSION['user']['username']);
            $result = $user->updateProfile();

            if ($result) {
                // Update successful
                $_SESSION['success'] = ['updateprofile' => 'Profile updated successfully.'];
                header("Location: /cb008920/public/manageprofile");
                exit;
            } else {
                // Update failed
                $_SESSION['errors'] = ['updateprofile' => 'Update failed. Please try again.'];
            }
        } else {
            // If not a POST request, show the update profile form
            require_once APP_PATH . 'views/shared/manageprofile.php';
        }
    }

    public function updatePassword()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateUpdatePasswordForm();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/manageprofile");
                exit('Redirecting...');
            }

            require_once APP_PATH . 'model/user.php';
            $user = new User();
            $user->loadFromArray($_POST);
            $user->setUsername($_SESSION['user']['username']);
            $result = $user->updatePassword($_POST['cPassword'], $_POST['nPassword']);

            if ($result) {
                // Update successful
                $_SESSION['success'] = ['updatepassword' => 'Password updated successfully.'];
                header("Location: /cb008920/public/manageprofile");
                exit;
            } else {
                // Update failed
                $_SESSION['errors'] = ['updatepassword' => 'Update failed. Please try again.'];
            }
        } else {
            // If not a POST request, show the update password form
            require_once APP_PATH . 'views/shared/manageprofile.php';
        }
    }
}
