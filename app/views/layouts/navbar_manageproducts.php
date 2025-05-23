<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();
?>


<div class="flex md:w-[30%] justify-between items-center mx-auto w-[90%] h-10 mt-5 mb-5 bg-gray-500 p-4 rounded-lg shadow-md">
    <a href="/cb008920/manageproducts" class="hover:text-white transition-colors duration-300">All Products</a>
    <?php if ($session->isSeller()): ?>
        <a href="/cb008920/createproduct" class="hover:text-white transition-colors duration-300">Create Products</a>
    <?php elseif ($session->isAdmin()): ?>
        <a href="/cb008920/featuring" class="hover:text-white transition-colors duration-300">Feature Products</a>
    <?php endif; ?>
</div>