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
        <form action="/cb008920/public/login" method="post">
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
            <button type="submit" class="my_btn mt-5">LOG IN</button>
            <p class="text-red"><?= $errors['login'] ?? ''  ?></p>
        </form>
    </div>
    <a href="cb008920/public/register" class="text-2xl font-semibold hover:text-skyblue p-4">Click To Register...</a>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>