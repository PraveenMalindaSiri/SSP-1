<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php require_once(LAYOUT_PATH . "navbar_products.php"); ?>


<div>
    <p class="text-center text-4xl font-bold blur-xs uppercase tracking-widest text-skyblue">Digital Editions</p>
</div>


<?php if (isset($products) && is_array($products) && count($products) > 0): ?>
    <div class="bg-gray-700 mb-5">
        <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
            <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">RPG</h1>
        </div>
        <!-- Products -->
        <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
            <div class="flex justify-between">
                <?php $hasProducts = false ?>
                <?php foreach ($products as $product): ?>
                    <?php if (strtolower($product['type']) === 'digital' && strtolower($product['genre']) === "rpg"): ?>
                        <?php $hasProducts = true ?>
                        <a href="/cb008920/productview?pid=<?= $product['pid'] ?>">
                            <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                                <img src="/cb008920/public/<?= $product['img_path'] ?>" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                                <h2 class="text-lg font-semibold"><?= ucwords($product['name']) ?></h2>
                                <p class="text-sm text-gray-300"><?= ucfirst($product['type']) ?></p>
                                <p class="text-yellow-400 font-bold mt-2"><?= $product['price'] ?></p>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if (!$hasProducts): ?>
                <p class="text-white text-center text-2xl">No Shooter Games</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-gray-700 mb-5">
        <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
            <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">Shooter</h1>
        </div>
        <!-- Products -->
        <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
            <div class="flex justify-between">
                <?php $hasProducts = false ?>
                <?php foreach ($products as $product): ?>
                    <?php if (strtolower($product['type']) === 'digital' && strtolower($product['genre']) === "shooter"): ?>
                        <?php $hasProducts = true ?>
                        <a href="/cb008920/productview?pid=<?= $product['pid'] ?>">
                            <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                                <img src="/cb008920/public/<?= $product['img_path'] ?>" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                                <h2 class="text-lg font-semibold"><?= ucwords($product['name']) ?></h2>
                                <p class="text-sm text-gray-300"><?= ucfirst($product['type']   ) ?></p>
                                <p class="text-yellow-400 font-bold mt-2"><?= $product['price'] ?></p>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if (!$hasProducts): ?>
                <p class="text-white text-center text-2xl">No Shooter Games</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-gray-700 mb-5">
        <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
            <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">Car</h1>
        </div>
        <!-- Products -->
        <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
            <div class="flex justify-between">
                <?php $hasProducts = false ?>
                <?php foreach ($products as $product): ?>
                    <?php if (strtolower($product['type']) === 'digital' && strtolower($product['genre']) === "car"): ?>
                        <?php $hasProducts = true ?>
                        <a href="/cb008920/productview?pid=<?= $product['pid'] ?>">
                            <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                                <img src="/cb008920/public/<?= $product['img_path'] ?>" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                                <h2 class="text-lg font-semibold"><?= ucwords($product['name']) ?></h2>
                                <p class="text-sm text-gray-300"><?= ucfirst($product['type']) ?></p>
                                <p class="text-yellow-400 font-bold mt-2"><?= $product['price'] ?></p>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if (!$hasProducts): ?>
                <p class="text-white text-center text-2xl">No Car Games</p>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <p class="text-center text-2xl">No Products</p>
<?php endif; ?>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>