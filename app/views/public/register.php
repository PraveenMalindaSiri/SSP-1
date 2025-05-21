<?php require_once(LAYOUT_PATH . "navbar.php"); ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Register</h1>
        <form action="/cb008920/public/register" method="post">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username"  value="<?= htmlspecialchars($old['username'] ?? '') ?>">
                <p class="text-red"><?= $errors['username'] ?? '' ?></p>
            </div>
            <div>
                <label for="password">Password</label><br>
                <input class="my_input" type="password" id="password" name="password"  value="<?= htmlspecialchars($old['password'] ?? '') ?>">
                <p class="text-red"><?= $errors['password'] ?? ''  ?></p>
            </div>
            <div>
                <label for="fullname">Fullname</label><br>
                <input class="my_input" type="text" id="fullname" name="fullname"  value="<?= htmlspecialchars($old['fullname'] ?? '') ?>">
                <p class="text-red"><?= $errors['fullname'] ?? ''  ?></p>
            </div>
            <div>
                <label for="address">Address</label><br>
                <input class="my_input" type="text" id="address" name="address"  value="<?= htmlspecialchars($old['address'] ?? '') ?>">
                <p class="text-red"><?= $errors['address'] ?? ''  ?></p>
            </div>
            <div>
                <label for="email">Email</label><br>
                <input class="my_input" type="email" id="email" name="email"  value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                <p class="text-red"><?= $errors['email'] ?? ''  ?></p>
            </div>
            <div>
                <label for="dob">Date of Birth (DoB)</label><br>
                <input class="my_input" type="date" id="dob" name="dob"  value="<?= htmlspecialchars($old['dob'] ?? '') ?>">
                <p class="text-red"><?= $errors['email'] ?? ''  ?></p>
            </div>
            <div class="w-[50%]">
                <label>Select Role</label>
                <div class="flex items-center space-x-4 justify-between mt-5">
                    <div>
                        <input type="radio" id="seller" name="role" value="seller" >
                        <label for="seller" class="p-4">Seller</label>
                    </div>
                    <div>
                        <input type="radio" id="customer" name="role" value="customer" >
                        <label for="customer" class="p-4">Customer</label>
                    </div>
                    <div>
                        <input type="radio" id="admin" name="role" value="admin" >
                        <label for="admin" class="p-4">Admin</label>
                    </div>
                </div>
                <p class="text-red"><?= $errors['role'] ?? ''  ?></p>
            </div>
            <button type="submit" class="my_btn mt-5">REGISTER</button>
            <p class="text-red"><?= $errors['register'] ?? ''  ?></p>

        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>