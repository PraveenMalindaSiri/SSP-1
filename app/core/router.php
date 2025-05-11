<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = str_replace('/cb008920/public', '', $uri);

$routes = [
    '/' => 'public/home.php',
    '/home' => 'public/home.php',
    '/physicalproducts' => 'public/physicalproducts.php',
    '/digitalproducts' => 'public/digitalproducts.php',
    '/about' => 'public/about.php',
    '/login' => 'public/login.php',
    '/register' => 'public/register.php',
    '/cart' => 'customer/cart.php',
    '/wishlist' => 'customer/wishlist.php',
    '/manageprofile' => 'shared/manageprofile.php',    
];

echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Parsed URI: " . $uri . "<br>";

function loadController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require_once APP_PATH . 'views/' . $routes[$uri];
    } else {
        http_response_code(404);
        require_once APP_PATH . 'views/public/404.php';
    }
}

loadController($uri, $routes);