<?php require_once("../../../public/index.php"); ?>
<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update User Profile Details</h1>
        <form action="">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="fullname">Fullname</label><br>
                <input class="my_input" type="text" id="fullname" name="fullname">
            </div>
            <div>
                <label for="address">Address</label><br>
                <input class="my_input" type="text" id="address" name="address">
            </div>
            <div>
                <label for="phoneNum">Phone Number</label><br>
                <input class="my_input" type="number" id="phoneNum" name="phoneNum">
            </div>
            <div>
                <label for="email">Email</label><br>
                <input class="my_input" type="email" id="email" name="email">
            </div>
            <button type="submit" class="my_btn mt-5">UPDATE</button>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>