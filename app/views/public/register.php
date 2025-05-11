<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Register</h1>
        <form action="">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input class="my_input" type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="fullname">Fullname</label><br>
                <input class="my_input" type="text" id="fullname" name="fullname" required>
            </div>
            <div>
                <label for="address">Address</label><br>
                <input class="my_input" type="text" id="address" name="address" required>
            </div>
            <div>
                <label for="phoneNum">Phone Number</label><br>
                <input class="my_input" type="number" id="phoneNum" name="phoneNum" required max="9999999999" min="1000000000" maxlength="10">
            </div>
            <div>
                <label for="email">Email</label><br>
                <input class="my_input" type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="my_btn mt-5">REGISTER</button>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>