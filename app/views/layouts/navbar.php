<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/cb008920/public/assets/css/styles.css" rel="stylesheet">
</head>

<body>
    <header class="bg-gray-800 text-white pr-10 pl-10 pt-4 pb-4">
        <nav class="flex justify-between items-center mx-auto w-[90%]">
            <div>
                <a href="/cb008920/public/home">
                    <h1 class="text-3xl text-skyblue hover:text-white">GameNova</h1>
                </a>
            </div>
            <div class="nav-links duration-500 absolute md:static md:min-h-fit md:w-auto bg-gray-800 w-full h-16 top-[-100%] left-0 min-h-[60vh] flex items-center">
                <ul class="flex md:flex-row flex-col items-center justify-center md:items-center md:gap-[4vw] gap-10 w-full">
                    <li><a href="/cb008920/public/home" class="hover:text-cyan-400 text-xl transition-colors duration-300">Home</a></li>
                    <li><a href="/cb008920/public/physicalproducts" class="hover:text-cyan-400 text-xl transition-colors duration-300">Products</a></li>
                    <li><a href="/cb008920/public/about" class="hover:text-cyan-400 text-xl transition-colors duration-300">About</a></li>
                    <?php
                    if ($session->isLoggedIn() && $session->isCustomer()) {
                        echo '                    <li><a href="/cb008920/public/wishlist" class="hover:text-cyan-400 text-xl transition-colors duration-300">Wishlist</a></li>
                    <li><a href="/cb008920/public/cart" class="hover:text-cyan-400 text-xl transition-colors duration-300">Cart</a></li>';
                    }
                    if ($session->isLoggedIn() && $session->isAdmin()) {
                        echo '<li><a href="/cb008920/public/manageproducts" class="hover:text-cyan-400 text-xl transition-colors duration-300">Manage Products</a></li>
                        <li><a href="/cb008920/public/manageusers" class="hover:text-cyan-400 text-xl transition-colors duration-300">Manage Users</a></li>';
                    }
                    if ($session->isLoggedIn() && $session->isSeller()) {
                        echo '<li><a href="/cb008920/public/manageproducts" class="hover:text-cyan-400 text-xl transition-colors duration-300">Manage Products</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="flex items-center gap-10">
                <a href="/cb008920/public/manageprofile"><img src="/cb008920/public/assets/images/main/avatar-white.png" alt="profile" class="w-10 h-10 hover:-translate-y-1 transition ease-in-out delay-75"></a>
                <button class="text-3xl cursor-pointer md:hidden w-7 h-7" id="menu-toggle" name="menu"><img id="menu-img" src="/cb008920/public/assets/images/main/menu.png" alt="menu"></button>
            </div>
        </nav>
    </header>
    <script src="/cb008920/public/assets/js/navigation.js"></script>
</body>

</html>