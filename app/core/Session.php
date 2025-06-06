<?php

class Session
{
    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function setUser($username, $role, $age)
    {
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $role,
            'age' => $age
        ];
    }
    public function unsetUser()
    {
        unset($_SESSION['user']);
    }
    public function setCartItems($pid, $amount, $username)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$username])) {
            $_SESSION['cart'][$username] = [];
        }

        $Currentamount = $_SESSION['cart'][$username][$pid] ?? 0;
        if ($Currentamount == 0) {
            $_SESSION['cart'][$username][$pid] = $amount;
        } else {
            $_SESSION['cart'][$username][$pid] = $amount + $Currentamount;
        }
        return true;
    }
    public function setCartTotal($totalp, $user)
    {
        $_SESSION['cart_total'][$user] = $totalp;
        return true;
    }
    public function unsetCartItem($username, $pid)
    {
        if (isset($_SESSION['cart'][$username][$pid])) {
            unset($_SESSION['cart'][$username][$pid]);
            return true;
        }
        return false;
    }
    public function unsetCart($username)
    {
        if (isset($_SESSION['cart'][$username])) {
            unset($_SESSION['cart'][$username]);
            return true;
        }
        return false;
    }
        public function unsetCartTotal($username)
    {
        if (isset($_SESSION['cart_total'][$username])) {
            unset($_SESSION['cart_total'][$username]);
            return true;
        }
        return false;
    }
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
    }

    public function isCustomer()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'customer';
    }

    public function isSeller()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'seller';
    }
}
