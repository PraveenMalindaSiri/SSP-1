<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = str_replace('/cb008920/public', '', $uri);
$uri = rtrim($uri, '/');

$routes = [
    '' => ['view' => 'public/home.php'],
    '/home' => ['view' => 'public/home.php'],
    '/physicalproducts' => ['view' => 'public/physicalproducts.php'],
    '/digitalproducts' => ['view' => 'public/digitalproducts.php'],
    '/about' => ['view' => 'public/about.php'],
    '/cart' => ['view' => 'customer/cart.php'],
    '/wishlist' => ['view' => 'customer/wishlist.php'],
    '/manageprofile' => ['view' => 'shared/manageprofile.php'],
    '/manageproducts' => ['view' => 'shared/manageproducts.php'],
    '/manageusers' => ['view' => 'admin/manageusers.php'],

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
    '/createproduct' => [
        'controller' => 'ProductController',
        'method' => 'createProduct'
    ],
    '/updateproduct' => [
        'controller' => 'ProductController',
        'method' => 'updateProduct'
    ],
    '/deleteproduct' => [
        'controller' => 'ProductController',
        'method' => 'deleteProduct'
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
