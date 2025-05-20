<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();

$success = $_SESSION['success'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);
?>


<div class="flex justify-center">
    <button class="flex mt-5 my_btn">
        <?php
        if ($session->isLoggedIn()) {
            echo '<a href="/cb008920/public/logout" class="flex">LOG OUT</a>';
        } else {
            echo '<a href="/cb008920/public/login" class="flex">LOG IN</a>';
        }
        ?>
        <img src="/cb008920/public/assets/images/main/power-switch.png" alt="" class="w-7 h-7 pl-4">
    </button>
</div>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update Profile Details</h1>
        <form action="/cb008920/public/update-profile" method="POST">
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
            <?php if ($session->isLoggedIn())
                echo '<button type="submit" class="my_btn mt-5">UPDATE</button>'
            ?>
            <p class="text-red"><?= $success['updateprofile'] ?? ''  ?></p>
            <p class="text-red"><?= $errors['updateprofile'] ?? ''  ?></p>
        </form>
    </div>

    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update Password</h1>
        <form action="/cb008920/public/update-password" method="POST">
            <div>
                <label for="cPassword">Current Password</label><br>
                <input class="my_input" type="password" id="cPassword" name="cPassword" required value="<?= htmlspecialchars($old['cPassword'] ?? '') ?>">
                <p class="text-red"><?= $errors['cPassword'] ?? ''  ?></p>
            </div>
            <div>
                <label for="nPassword">New Password</label><br>
                <input class="my_input" type="password" id="nPassword" name="nPassword" required value="<?= htmlspecialchars($old['nPassword'] ?? '') ?>">
                <p class="text-red"><?= $errors['nPassword'] ?? ''  ?></p>
            </div>
            <div>
                <label for="conPassword">Confirm Password</label><br>
                <input class="my_input" type="password" id="conPassword" name="conPassword" required value="<?= htmlspecialchars($old['conPassword'] ?? '') ?>">
                <p class="text-red"><?= $errors['conPassword'] ?? ''  ?></p>
                <p class="text-red"><?= $errors['Passwords'] ?? ''  ?></p>
            </div>
            <?php if ($session->isLoggedIn())
                echo '<button type="submit" class="my_btn mt-5">CONFIRM</button>'
            ?>
            <p class="text-red"><?= $success['updatepassword'] ?? ''  ?></p>
            <p class="text-red"><?= $errors['updatepassword'] ?? ''  ?></p>
        </form>
    </div>

    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update Profile Picture</h1>
        <form action="/cb008920/public/update-picture" enctype="multipart/form-data" method="post">
            <div>
                <label for="picture">Profile Picture</label><br>
                <input type="file" id="picture" name="picture" class="my_input" required>
            </div>
            <?php if($session->isLoggedIn())
            echo '<button type="submit" class="my_btn mt-5">SAVE</button>'
            ?>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>