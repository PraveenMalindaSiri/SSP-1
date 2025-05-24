<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$session = new Session();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<div>
    <p class="text-white">a</p>
</div>

<?php if (isset($product) && is_array($product) && count($product) > 0): ?>
    <form action="/cb008920/productview-submit" method="post">
        <div class="flex justify-center">
            <div class="flex flex-col w-[90%] items-center bg-gray-700 text-white rounded-xl shadow-lg">
                <div class="flex md:flex-row flex-col mt-10 items-center">
                    <h2 class="text-2xl"><?= ucwords($product['name']) ?></h2>
                    <h2 class="text-2xl"><?= $product['price'] ?></h2>
                </div>
                <div class="pt-10">
                    <img src="/cb008920/public/<?= $product['img_path'] ?>" alt="" width="500" height="500" class="rounded-xl">
                </div>
                <div class="text-justify text-xl w-[90%] pt-10">
                    <p class="text-center"><?= $product['description'] ?></p>
                </div>
                <div class="flex md:flex-row flex-col gap-10 text-xl items-center justify-center">
                    <div class="flex flex-col">
                        <p class="pt-2">Edition: <?= ucfirst($product['type']) ?></p>
                        <p class="pt-2">Released Date: <?= $product['released_date'] ?></p>
                        <p class="pt-2">Age Rating: <?= $product['age_rating'] ?></p>
                        <p class="pt-2">Size: <?= $product['size'] ?></p>
                    </div>
                    <div class="flex flex-col">
                        <p class="pt-2">Platform: <?= strtoupper($product['platform']) ?></p>
                        <p class="pt-2">Company: <?= $product['company'] ?></p>
                        <p class="pt-2">Duration: <?= $product['duration'] ?></p>
                        <p class="pt-2">Genre: <?= strtoupper($product['genre']) ?></p>
                    </div>
                </div>
                <div class="flex md:flex-row flex-col gap-4">
                    <?php if ($product['type'] !== 'Digital'): ?>
                        <div>
                            <div class="flex flex-row items-center gap-2 pt-2">
                                <label for="amount">Amount:</label>
                                <input class="my_input" type="number" id="amount" name="amount" min="1" value="1">
                            </div>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="pid" value="<?= htmlspecialchars($product['pid']) ?>">
                    <input type="hidden" name="type" value="<?= htmlspecialchars($product['type']) ?>">
                    <input type="hidden" name="age" value="<?= htmlspecialchars($product['age_rating']) ?>">
                    <?php if ($session->isCustomer()): ?>
                        <div class="flex flex-row items-center gap-4">
                            <button class="my_btn" type="submit" name="action" value="wishlist">Add to Wishlist</button>
                            <button class="my_btn" type="submit" name="action" value="cart">Add to Cart</button>
                        </div>
                    <?php endif; ?>
                    <?php if ($session->isAdmin() || $session->isSeller()): ?>
                        <div class="flex flex-row items-center gap-4">
                            <a href="/cb008920/manageproducts" class="my_btn">Manage</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
    <div class="text-center text-xl border-2">
        <p class="text-red"><?= $errors['age'] ?? ''  ?></p>
        <p class="text-red"><?= $errors['amount'] ?? ''  ?></p>
        <p class="text-red"><?= $errors['pid'] ?? ''  ?></p>
        <p class="text-red"><?= $errors['wishlist'] ?? ''  ?></p>
        <p class="text-red"><?= $errors['cart'] ?? ''  ?></p>
    </div>
<?php else: ?>
    <p class="text-xl">No Item</p>
<?php endif; ?>
<div>
    <p class="text-white">adc</p>
</div>

<?php require_once(LAYOUT_PATH . "footer.php"); ?>