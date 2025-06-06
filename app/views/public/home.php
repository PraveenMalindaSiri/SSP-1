<?php require_once(LAYOUT_PATH . "navbar.php"); ?>



<div>
    <div style="background-image: url('/cb008920/public/assets/images/main/main img.png');" class="hidden md:block bg-cover bg-center h-100 w-auto text-white ">
        <h1 class="md:text-6xl font-bold p-4 ml-10 pt-5">Welcome to GameNova.</h1>
        <p class="md:text-2xl text-left w-1/3 p-4 ml-10 mt-10">Level up your game collection now.
            Buy physical or digital edition of your next game.
            No region locks. No other barriers. Just pure gaming vibe.
            Gear up and game on!
        </p>
    </div>
    <div style="background-image: url('/cb008920/public/assets/images/main/main img - mobile.png');" class="md:hidden bg-cover bg-center h-180 w-auto text-white ">
        <h1 class="text-4xl font-bold ml-10 pt-5">Welcome to GameNova.</h1>
        <p class="text-2xl text-left pt-10 w-auto ml-10">Level up your game collection now.
            Buy physical or digital edition of your next game.
            No region locks. No other barriers. Just pure gaming vibe.
            Gear up and game on!
        </p>
    </div>
</div>

<div class="flex flex-col md:flex-row justify-between items-center gap-4 m-5">
    <div><img src="/cb008920/public/assets/images/main/intro_img.jpg" alt="Intro Image" class="rounded-lg" width="300"></div>
    <div> <video autoplay muted loop class="rounded-lg">
            <source src="/cb008920/public/assets/images/main/intro_vid.mp4" type="video/mp4">
        </video>
    </div>
    <div><img src="/cb008920/public/assets/images/main/intro_img2.jpg" alt="Intro Image" class="rounded-lg"  width="300"></div>
</div>

<div>
    <p class="text-center text-4xl font-bold blur-xs uppercase tracking-widest text-skyblue">Featuring Games</p>
</div>

<div class="bg-gray-700">
    <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
        <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">Physical Editions</h1>
        <a href="/cb008920/physicalproducts" class="text-2xl md:text-2xl font-bold text-neon hover:text-white pt-10">See more...</a>
    </div>
    <!-- Products -->
    <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
        <div class="flex justify-between">
            <?php $hasProducts = false ?>
            <?php foreach ($products as $product): ?>
                <?php if (strtolower($product['type']) === 'physical'): ?>
                    <?php $hasProducts = true ?>
                    <a href="/cb008920/productview?pid=<?= $product['pid'] ?>">
                        <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                            <img src="/cb008920/public/<?= $product['img_path'] ?>" alt=<?= $product['name'] ?> class="w-full h-40 object-cover rounded-lg mb-3">
                            <h2 class="text-lg font-semibold"><?= $product['name'] ?></h2>
                            <p class="text-sm text-gray-300"><?= $product['type'] ?></p>
                            <p class="text-yellow-400 font-bold mt-2"><?= $product['price'] ?></p>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php if (!$hasProducts): ?>
            <p class="text-white text-center text-2xl">No Physical Editions for featuring</p>
        <?php endif; ?>
    </div>
</div>

<div class="bg-gray-700 mb-5">
    <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
        <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">Digital Editions</h1>
        <a href="/cb008920/digitalproducts" class="text-2xl md:text-2xl font-bold text-neon hover:text-white pt-10">See more...</a>
    </div>
    <!-- Products -->
    <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
        <div class="flex justify-between">
            <?php $hasProducts = false ?>
            <?php foreach ($products as $product): ?>
                <?php if (strtolower($product['type']) === 'digital'): ?>
                    <?php $hasProducts = true ?>
                    <a href="/cb008920/productview?pid=<?= $product['pid'] ?>">
                        <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                            <img src="/cb008920/public/<?= $product['img_path'] ?>" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                            <h2 class="text-lg font-semibold"><?= $product['name'] ?></h2>
                            <p class="text-sm text-gray-300"><?= $product['type'] ?></p>
                            <p class="text-yellow-400 font-bold mt-2"><?= $product['price'] ?></p>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php if (!$hasProducts): ?>
            <p class="text-white text-center text-2xl">No Digital Editions for featuring</p>
        <?php endif; ?>
    </div>
</div>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>