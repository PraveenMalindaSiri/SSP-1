<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();

$success = $_SESSION['success'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

$addsuccess = $_SESSION['addsuccess'] ?? [];
$adderrors = $_SESSION['adderrors'] ?? [];
$addold = $_SESSION['addold'] ?? [];

unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success'],$_SESSION['adderrors'], $_SESSION['addold'], $_SESSION['addsuccess']);
?>

<?php
require_once(LAYOUT_PATH . "navbar_manageproducts.php");
?>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">ADD FEATURING PRODUCT</h1>
        <form action="/cb008920/feature-add" method="POST">
            <div>
                <label for="pid">Product ID</label><br>
                <input class="my_input" type="number" id="pid" name="pid" value="<?= htmlspecialchars($addold['pid'] ?? '') ?>">
                <p class="text-red"><?= $adderrors['pid'] ?? '' ?></p>
            </div>
            <p class="text-red"><?= $adderrors['feature'] ?? ''  ?></p>
            <p class="text-red"><?= $addsuccess['feature'] ?? ''  ?></p>
            <button type="submit" class="my_btn mt-5">ADD</button>
        </form>
    </div>
</div>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">REMOVE FEATURING PRODUCT</h1>
        <form action="/cb008920/feature-remove" method="POST">
            <div>
                <label for="pid">Product ID</label><br>
                <input class="my_input" type="number" id="pid" name="pid" value="<?= htmlspecialchars($old['pid'] ?? '') ?>">
                <p class="text-red"><?= $errors['pid'] ?? '' ?></p>
            </div>
            <p class="text-red"><?= $errors['remove'] ?? ''  ?></p>
            <p class="text-red"><?= $success['remove'] ?? ''  ?></p>
            <button type="submit" class="my_btn mt-5">REMOVE</button>
        </form>
    </div>
</div>

<?php require_once(LAYOUT_PATH . "footer.php"); ?>