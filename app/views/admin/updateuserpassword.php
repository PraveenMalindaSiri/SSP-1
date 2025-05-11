<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update User Password</h1>
        <form action="">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" required>
            </div>
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
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>