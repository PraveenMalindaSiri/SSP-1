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
        <h1 class="text-2xl mb-5">Update User Profile Details</h1>
        <form action="/cb008920/public/updateuserdetails" method="post">
            <div>
                <label for="username">Username</label><br>
                <input class="my_input" type="text" id="username" name="username" required value="<?= $username ?>">
                <p class="text-red"><?= $errors['username'] ?? ''  ?></p>
            </div>
            <div>
                <label for="fullname">Fullname</label><br>
                <input class="my_input" type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($old['fullname'] ?? '') ?>">
                <p class="text-red"><?= $errors['fullname'] ?? ''  ?></p>
            </div>
            <div>
                <label for="address">Address</label><br>
                <input class="my_input" type="text" id="address" name="address" value="<?= htmlspecialchars($old['address'] ?? '') ?>">
                <p class="text-red"><?= $errors['address'] ?? ''  ?></p>
            </div>
            <div>
                <label for="email">Email</label><br>
                <input class="my_input" type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                <p class="text-red"><?= $errors['email'] ?? ''  ?></p>
            </div>
            <button type="submit" class="my_btn mt-5">UPDATE</button>
            <p class="text-red"><?= $success['updateprofile'] ?? ''  ?></p>
            <p class="text-red"><?= $errors['updateprofile'] ?? ''  ?></p>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>