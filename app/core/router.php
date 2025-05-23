<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = str_replace('/cb008920/public', '', $uri);
$uri = rtrim($uri, '/');

$routes = [
    '' => ['view' => 'public/home.php'],
    '/home' => ['view' => 'public/home.php'],
    '/about' => ['view' => 'public/about.php'],
    '/manageprofile' => ['view' => 'shared/manageprofile.php'],

    '/physicalproducts' => [
        'controller' => 'ProductController',
        'method' => 'showProducts'
    ],
    '/digitalproducts' => [
        'controller' => 'ProductController',
        'method' => 'showProducts'
    ],
    // profile settings ============================================
    '/update-profile' => [
        'controller' => 'UserController',
        'method' => 'updateProfile'
    ],
    '/update-password' => [
        'controller' => 'UserController',
        'method' => 'updatePassword'
    ],
    '/upload-picture' => [
        'controller' => 'UserController',
        'method' => 'uploadPicture'
    ],
    // authentication ============================================
    '/register' => [
        'controller' => 'UserController',
        'method' => 'register'
    ],
    '/login' => [
        'controller' => 'UserController',
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => 'UserController',
        'method' => 'logout'
    ],
    // product management ============================================
    '/createproduct' => [
        'controller' => 'ProductController',
        'method' => 'createProduct'
    ],
    '/manageproducts' => [
        'controller' => 'ProductController',
        'method' => 'getAllProducts'
    ],
    '/updateproduct' => [
        'controller' => 'ProductController',
        'method' => 'updateProducts'
    ],
    '/deleteproduct' => [
        'controller' => 'ProductController',
        'method' => 'deleteProducts'
    ],
    // product details ============================================
    '/productview' => [
        'controller' => 'ProductController',
        'method' => 'productDetails'
    ],
    '/productview-submit' => [
        'controller' => 'CustomerController',
        'method' => 'customerSelection'
    ],
    // wishlist ============================================
    '/wishlist' => [
        'controller' => 'CustomerController',
        'method' => 'showWishlistItems'
    ],
    '/wishlist-submit' => [
        'controller' => 'CustomerController',
        'method' => 'wishlistSelection'
    ],
    // cart ============================================
    '/cart' => [
        'controller' => 'CustomerController',
        'method' => 'showCartItems'
    ],
    '/cart-submit' => [
        'controller' => 'CustomerController',
        'method' => 'cartSelection'
    ],
    // ADMIN ++++++++++++++++++++++++++++++++++++++++++++
    '/manageusers' => [
        'controller' => 'AdminController',
        'method' => 'getAllUsers'
    ],
    '/updateuserpassword' => [
        'controller' => 'AdminController',
        'method' => 'updateUserPassword'
    ],
    '/updateuserdetails' => [
        'controller' => 'AdminController',
        'method' => 'updateUserDetails'
    ],
    '/deleteuser' => [
        'controller' => 'AdminController',
        'method' => 'deleteUser'
    ],
    // customer ==========================================
    '/cart-checkout' => [
        'controller' => 'CustomerController',
        'method' => 'checkout'
    ],
    '/checkout' => [
        'controller' => 'CustomerController',
        'method' => 'payment'
    ],
    '/thank' => [
        'controller' => 'CustomerController',
        'method' => 'thank'
    ],
    // Orders ==========================================
    '/orders' => [
        'controller' => 'UserController',
        'method' => 'orders'
    ],
    '/vieworder' => [
        'controller' => 'UserController',
        'method' => 'orderDetails'
    ],
];

echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Parsed URI: " . $uri . "<br>";

function loadController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        $route = $routes[$uri];

        if (isset($route['controller'])) {
            require_once APP_PATH . 'controller/' . $route['controller'] . '.php';
            $controllerInstance = new $route['controller']();
            $method = $route['method'];
            $controllerInstance->$method();
        } else {
            require_once APP_PATH . 'views/' . $route['view'];
        }
    } else {
        http_response_code(404);
        require_once APP_PATH . 'views/public/404.php';
    }
}

loadController($uri, $routes);
