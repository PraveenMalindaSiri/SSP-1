<?php require_once("../../../public/index.php"); ?>
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
<div class="bg-gray-700">
    <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
        <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">Physical Editions</h1>
        <a href="../public/physicalproducts.php" class="text-2xl md:text-2xl font-bold text-cyan-400 hover:text-white pt-10">See more...</a>
    </div>
    <!-- Products -->
    <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
        <div class="flex justify-between">
            <a href="">
                <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                    <img src="/images/game1.jpg" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                    <h2 class="text-lg font-semibold">Game Title 1</h2>
                    <p class="text-sm text-gray-300">Digital / Physical</p>
                    <p class="text-yellow-400 font-bold mt-2">$29.99</p>
                </div>
            </a>

            <a href="">
                <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                    <img src="/images/game1.jpg" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                    <h2 class="text-lg font-semibold">Game Title 1</h2>
                    <p class="text-sm text-gray-300">Digital / Physical</p>
                    <p class="text-yellow-400 font-bold mt-2">$29.99</p>
                </div>
            </a>

            <a href="">
                <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                    <img src="/images/game1.jpg" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                    <h2 class="text-lg font-semibold">Game Title 1</h2>
                    <p class="text-sm text-gray-300">Digital / Physical</p>
                    <p class="text-yellow-400 font-bold mt-2">$29.99</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="bg-gray-700 mb-5">
    <div class="flex flex-row justify-between w-[90%] mx-auto mt-5 mb-5">
        <h1 class="text-2xl md:text-2xl font-bold text-white pt-10">Digital Editions</h1>
        <a href="../public/physicalproducts.php" class="text-2xl md:text-2xl font-bold text-cyan-400 hover:text-white pt-10">See more...</a>
    </div>
    <!-- Products -->
    <div class="overflow-x-auto whitespace-nowrap px-4 py-6 pl-10 pr-10">
        <div class="flex justify-between">
            <a href="">
                <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                    <img src="/images/game1.jpg" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                    <h2 class="text-lg font-semibold">Game Title 1</h2>
                    <p class="text-sm text-gray-300">Digital / Physical</p>
                    <p class="text-yellow-400 font-bold mt-2">$29.99</p>
                </div>
            </a>
            
            <a href="">
                <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                    <img src="/images/game1.jpg" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                    <h2 class="text-lg font-semibold">Game Title 1</h2>
                    <p class="text-sm text-gray-300">Digital / Physical</p>
                    <p class="text-yellow-400 font-bold mt-2">$29.99</p>
                </div>
            </a>

            <a href="">
                <div class="inline-block w-60 mr-4 bg-gray-800 text-white rounded-xl shadow-lg p-4">
                    <img src="/images/game1.jpg" alt="Game 1" class="w-full h-40 object-cover rounded-lg mb-3">
                    <h2 class="text-lg font-semibold">Game Title 1</h2>
                    <p class="text-sm text-gray-300">Digital / Physical</p>
                    <p class="text-yellow-400 font-bold mt-2">$29.99</p>
                </div>
            </a>
        </div>
    </div>
</div>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>