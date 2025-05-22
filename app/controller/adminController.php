<?php
require_once APP_PATH . 'core/Validator.php';
require_once APP_PATH . 'model/admin.php';

class AdminController
{
    public function getAllUsers()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $users = [];

        $session = new Session();
        if ($session->isLoggedIn()) {
            $admin = new Admin();
            $users = $admin->getUsers();
        }

        require_once APP_PATH . 'views/admin/manageuser.php';
    }

    public function updateUserDetails()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $noInput = empty($_POST['fullname']) && empty($_POST['email']) && empty($_POST['address']);
            if ($noInput) {
                header("Location: /cb008920/public/manageusers");
                exit();
            }

            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateUpdateProfileFormAdmin();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/updateuserdetails?username=" . $_POST['username']);
                exit;
            }
            $session = new Session();
            if (!$session->isAdmin()) {
                header("Location: /cb008920/public");
                exit;
            }

            $admin = new Admin();
            $result = $admin->updateUsersDetails($_POST);

            if ($result) {
                // Update successful
                $_SESSION['success'] = ['updateprofile' => 'Profile updated successfully.'];
                header("Location: /cb008920/public/manageusers");
                exit;
            } else {
                // Update failed
                $_SESSION['errors'] = ['updateprofile' => 'Update failed. Please try again.'];
            }
        } else {
            require_once APP_PATH . 'views/admin/updateuserdetails.php';
        }
    }
    public function updateUserPassword()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::validateUpdatePasswordFormAdmin();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/updateuserpassword?username=" . $_POST['username']);
                exit;
            }
            $session = new Session();
            if (!$session->isAdmin()) {
                header("Location: /cb008920/public");
                exit;
            }

            $admin = new Admin();
            $result = $admin->updateUsersPassword($_POST);

            if ($result) {
                // Update successful
                $_SESSION['success'] = ['updatepassword' => 'Password updated successfully.'];
                header("Location: /cb008920/public/manageusers");
                exit;
            } else {
                // Update failed
                $_SESSION['errors'] = ['updatepassword' => 'Update failed. Please try again.'];
                header("Location: /cb008920/public/updateuserpassword?username=" . $_POST['username']);
                exit;
            }
        } else {
            require_once APP_PATH . 'views/admin/updateuserpassword.php';
        }
    }

    public function deleteUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = Validator::sanitize($_POST);
            Validator::$inputs = $_POST;
            $errors = Validator::isValidUser();

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                header("Location: /cb008920/public/deleteuser?username=" . $_POST['username']);
                exit;
            }
            $session = new Session();
            if (!$session->isAdmin()) {
                header("Location: /cb008920/public");
                exit;
            }

            $admin = new Admin();
            $result = $admin->deleteUsers($_POST['username']);

            if ($result) {
                $_SESSION['success'] = ['deleteuser' => 'Deleted User successfully.'];
                header("Location: /cb008920/public/manageusers");
                exit;
            }
            else{
                $_SESSION['errors'] = ['deleteuser' => 'Delete failed. Please try again.'];
            }
        } else {
            require_once APP_PATH . 'views/admin/deleteuser.php';
        }
    }
}
