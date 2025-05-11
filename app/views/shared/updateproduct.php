<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update</h1>
        <form action="" method="POST">
            <div>
                <label for="pid">Product ID</label><br>
                <input class="my_input" type="number" id="pid" name="pid" required>
            </div>
            <div>
                <label for="name">Name</label><br>
                <input class="my_input" type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="edition">Edition</label><br>
                <input class="my_input" type="text" id="edition" name="edition" required>
            </div>
            <div>
                <label for="genre">Genre</label><br>
                <input class="my_input" type="text" id="genre" name="genre" required>
            </div>
            <div>
                <label for="duration">Duration</label><br>
                <input class="my_input" type="number" id="duration" name="duration" required>
            </div>
            <div>
                <label for="platform">Platform</label><br>
                <input class="my_input" type="text" id="platform" name="platform" required>
            </div>
            <div>
                <label for="price">Price</label><br>
                <input class="my_input" type="number" id="price" name="price" required>
            </div>
            <div>
                <label for="releasedDate">Released Date</label><br>
                <input class="my_input" type="date" id="releasedDate" name="releasedDate" required>
            </div>
            <div>
                <label for="age">Age</label><br>
                <input class="my_input" type="number" id="age" name="age" required>
            </div>
            <div>
                <label for="size">Size</label><br>
                <input class="my_input" type="number" id="size" name="size" required>
            </div>
            <div>
                <label for="description">Description</label><br>
                <textarea class="my_input" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="my_btn mt-5">UPDATE</button>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>