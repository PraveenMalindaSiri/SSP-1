<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php $totalprice = 0 ?>
<pre><?php print_r($_SESSION['cart'] ?? []); ?></pre>

<?php if (isset($products) && is_array($products) && count($products) > 0): ?>
    <?php foreach ($products as $product): ?>
        <form action="/cb008920/public/cart-submit" method="post">
            <div class="mt-5 flex flex-col items-center">
                <div class="bg-gray-700 mb-5 w-[90%] flex flex-col md:flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
                    <img class="object-cover rounded-lg m-2 transition ease-in-out delay-100 hover:scale-110" src="/cb008920/public/<?= $product['img_path'] ?>" alt="<?= $product['name'] ?> - <?= $product['type'] ?>" width="300" height="300">
                    <a href="/cb008920/public/productview?pid=<?= $product['pid'] ?>" class="text-2xl font-semibold hover:text-skyblue">
                        <p><?= $product['name'] ?> - <?= $product['type'] ?> Edition</p>
                    </a>
                    <div class="flex flex-col items-center gap-4">
                        <div class="flex flex-col items-center gap-4">
                            <p class="text-xl font-semibold"><?= $product['amount'] ?></p>
                            <p class="text-xl font-semibold">Rs.<?= $product['price'] * $product['amount'] ?></p>
                            <?php $totalprice = $totalprice + ($product['price'] * $product['amount']) ?>
                        </div>
                        <input type="hidden" name="pid" value="<?= htmlspecialchars($product['pid']) ?>">
                        <div class="flex flex-col items-center gap-4">
                            <button class="my_btn" type="submit" name="action" value="remove">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-xl border-2">
                <p class="text-red"><?= $errors['delete'] ?? ''  ?></p>
                <p class="text-red"><?= $errors['pid'] ?? ''  ?></p>
            </div>
        </form>
    <?php endforeach; ?>

    <div class="flex flex-col items-center m-10 gap-x-10">
        <form action="/cb008920/public/checkout" method="post">
            <div class="flex flex-row items-center">
                <div>
                    <input type="checkbox">
                    <label for="" class="text-xl">Click Here to Agree with terms</label>
                </div>
                <div class="ml-10">
                    <p class="text-2xl">Rs.<?= $totalprice ?></p>
                    <input type="hidden" name="totalprice" id="totalprice" value="<?= $totalprice ?>">
                </div>
            </div>
            <div class="flex flex-col items-center">
                <button class="my_btn" type="submit" name="action" value="checkout">Checkout</button>
            </div>
        </form>
    </div>
<?php else: ?>
    <p>No Cart Items</p>
<?php endif; ?>
<p class="text-white">a</p>
<?php require_once(LAYOUT_PATH . "footer.php"); ?>