<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<?php if (isset($products) && is_array($products) && count($products) > 0): ?>
    <?php foreach ($products as $product): ?>
        <form action="/cb008920/public/wishlist-submit" method="post">
            <div class="mt-5 flex flex-col items-center">
                <div class="bg-gray-700 mb-5 w-[90%] flex flex-col md:flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
                    <img class="object-cover rounded-lg m-2 transition ease-in-out delay-100 hover:scale-110" src="/cb008920/public/<?= $product['img_path'] ?>" alt="<?= $product['name'] ?> - <?= $product['type'] ?>" width="300" height="300">
                    <a href="/cb008920/public/productview?pid=<?= $product['pid'] ?>" class="text-2xl font-semibold hover:text-skyblue">
                        <p><?= $product['name'] ?> - <?= $product['type'] ?> Edition</p>
                    </a>
                    <div class="flex flex-col items-center gap-4">
                        <div class="flex flex-col items-center gap-4">
                            <p class="text-xl font-semibold"><?= $product['amount'] ?></p>
                            <p class="text-xl font-semibold"><?= $product['price'] * $product['amount'] ?></p>
                        </div>
                        <div class="flex flex-col items-center gap-4">
                            <button class="my_btn" type="submit" name="action" value="cart">Add to Cart</button>
                            <button class="my_btn" type="submit" name="action" value="remove">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
<?php else: ?>
    <p>No Wishlist Items</p>
<?php endif; ?>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>