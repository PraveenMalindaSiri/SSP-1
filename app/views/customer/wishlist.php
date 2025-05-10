<?php require_once("../../../public/index.php"); ?>
<?php require_once(LAYOUT_PATH . "navbar.php"); ?>



<div class="mt-5 flex flex-col items-center">
    <div class="bg-gray-700 mb-5 w-[90%] flex flex-col md:flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
        <img class="object-cover rounded-lg m-2 transition ease-in-out delay-100 hover:scale-110" src="/cb008920/public/assets/images/main/main img.png" alt="" width="300" height="300">
        <a href="" class="text-2xl font-semibold hover:text-skyblue">
            <p>Witcher 3</p>
        </a>
        <div class="flex flex-col items-center gap-4">
            <div class="flex flex-col items-center gap-4">
                <p class="text-xl font-semibold">2</p>
                <p class="text-xl font-semibold">Rs. 3000</p>
            </div>
            <div class="flex flex-col items-center gap-4">
                <button class="my_btn">Add to Cart</button>
                <button class="my_btn">Remove</button>
            </div>
        </div>

        <!-- <div class="flex md:hidden flex-col items-center gap-4">
            <div class="flex flex-row items-center gap-4">
                <p class="text-xl font-semibold pr-10">2</p>
                <p class="text-xl font-semibold">Rs. 3000</p>
            </div>
            <div class="flex flex-row items-center gap-4">
                <button class="my_btn">Add to Cart</button>
                <button class="my_btn">Remove</button>
            </div>
        </div> -->
    </div>

</div>




<?php require_once(LAYOUT_PATH . "footer.php"); ?>