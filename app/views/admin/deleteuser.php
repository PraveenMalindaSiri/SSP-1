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
        <h1 class="text-2xl mb-5">Delete User</h1>
        <form action="/cb008920/public/deleteuser" method="post">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" required value="<?= htmlspecialchars($username ?? $old['username'] ?? '') ?>">
                <p class="text-red"><?= $errors['username'] ?? ''  ?></p>
            </div>
            <button type="submit" class="my_btn mt-5">DELETE</button>
            <p class="text-red"><?= $success['deleteuser'] ?? ''  ?></p>
            <p class="text-red"><?= $errors['deleteuser'] ?? ''  ?></p>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>