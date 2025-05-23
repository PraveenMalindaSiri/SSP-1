<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php $totalprice = 0;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>

<!-- <pre><?php print_r($products ?? []); ?></pre> -->


<?php if (isset($products) && is_array($products) && count($products) > 0): ?>
    <?php foreach ($products as $product): ?>
        <div class="mt-5 flex flex-col items-center">
            <div class="bg-gray-700 mb-5 w-[90%] flex flex-col md:flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
                <img class="object-cover rounded-lg m-2 transition ease-in-out delay-100 hover:scale-110" src="/cb008920/public/<?= $product['img_path'] ?>" alt="<?= $product['name'] ?> - <?= $product['type'] ?>" width="300" height="300">
                <a href="/cb008920/public/productview?pid=<?= $product['pid'] ?>" class="text-2xl font-semibold hover:text-skyblue">
                    <p><?= $product['name'] ?> - <?= $product['type'] ?> Edition</p>
                </a>
                <div class="flex flex-col items-center gap-4">
                    <div class="flex flex-col items-center gap-4">
                        <?php if (!$product['is_Digital']) : ?>
                            <p class="text-xl font-semibold"><?= $product['amount'] ?></p>
                        <?php else: ?>
                            <p class="text-xl font-semibold"><?= $product['code'] ?></p>
                        <?php endif; ?>
                        <p class="text-xl font-semibold">Rs.<?= $product['price'] * $product['amount'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="pb-4">
        <p class="text-xl text-center">
            Thank You <?= $_SESSION['user']['username'] ?>. Your Order has been placed successfully and will be sent to your address "<?= $_SESSION['address'] ?>".
        </p>
    </div>
<?php endif; ?>