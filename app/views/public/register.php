<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Register</h1>
        <form action="/cb008920/public/register/submit" method="post">
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
                <label for="email">Email</label><br>
                <input class="my_input" type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="dob">Date of Birth</label><br>
                <input class="my_input" type="date" id="dob" name="dob" required>
            </div>
            <div class="w-[50%]">
                <label>Select Role</label>
                <div class="flex items-center space-x-4 justify-between mt-5">
                    <div>
                        <input type="radio" id="seller" name="role" value="seller" required>
                        <label for="seller" class="p-4">Seller</label>
                    </div>
                    <div>
                        <input type="radio" id="seller" name="role" value="customer" required>
                        <label for="customer" class="p-4">Customer</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="my_btn mt-5">REGISTER</button>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>