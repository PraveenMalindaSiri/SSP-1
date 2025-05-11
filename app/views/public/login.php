<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <form action="">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input class="my_input" type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="my_btn mt-5">LOG IN</button>
        </form>
    </div>
    <a href="cb008920/public/register" class="text-2xl font-semibold hover:text-skyblue p-4">Click To Register...</a>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>