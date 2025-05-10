<?php require_once("../../../public/index.php"); ?>
<?php require_once(LAYOUT_PATH . "navbar.php"); ?>



<div class="flex justify-center">
    <button class="flex mt-5 my_btn">
        <a href="../public/login.php">LOG IN</a>
        <img src="/cb008920/public/assets/images/main/power-switch.png" alt="" class="w-7 h-7 pl-4">
    </button>
</div>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update Profile Details</h1>
        <form action="">
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

    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update Password</h1>
        <form action="">
            <div>
                <label for="cPassword">Current Password</label><br>
                <input class="my_input" type="password" id="cPassword" name="cPassword" required>
            </div>
            <div>
                <label for="nPassword">New Password</label><br>
                <input class="my_input" type="password" id="nPassword" name="nPassword" required>
            </div>
            <div>
                <label for="conPassword">Confirm Password</label><br>
                <input class="my_input" type="password" id="conPassword" name="conPassword" required>
            </div>
            <button type="submit" class="my_btn mt-5">CONFIRM</button>
        </form>
    </div>

    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update Profile Picture</h1>
        <form action="" enctype="multipart/form-data">
            <div>
                <label for="picture">Profile Picture</label><br>
                <input type="file" id="picture" name="picture" class="my_input" required>
            </div>
            <button type="submit" class="my_btn mt-5">SAVE</button>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>