<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();

$success = $_SESSION['success'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);

$username = $_GET['username'];

?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update User Password</h1>
        <form action="/cb008920/updateuserpassword" method="post">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" value="<?= $username ?>">
                <p class="text-red"><?= $errors['username'] ?? ''  ?></p>
            </div>
            <div>
                <label for="cPassword">Current Password</label><br>
                <input class="my_input" type="password" id="cPassword" name="cPassword" value="<?= htmlspecialchars($old['cPassword'] ?? '') ?>">
                <p class="text-red"><?= $errors['cPassword'] ?? ''  ?></p>
            </div>
            <div>
                <label for="nPassword">New Password</label><br>
                <input class="my_input" type="password" id="nPassword" name="nPassword" value="<?= htmlspecialchars($old['nPassword'] ?? '') ?>">
                <p class="text-red"><?= $errors['nPassword'] ?? ''  ?></p>
            </div>
            <div>
                <label for="conPassword">Confirm Password</label><br>
                <input class="my_input" type="password" id="conPassword" name="conPassword" value="<?= htmlspecialchars($old['conPassword'] ?? '') ?>">
                <p class="text-red"><?= $errors['conPassword'] ?? ''  ?></p>
                <p class="text-red"><?= $errors['Passwords'] ?? ''  ?></p>
            </div>
            <button type="submit" class="my_btn mt-5">CONFIRM</button>
            <p class="text-red"><?= $success['updatepassword'] ?? ''  ?></p>
            <p class="text-red"><?= $errors['updatepassword'] ?? ''  ?></p>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>