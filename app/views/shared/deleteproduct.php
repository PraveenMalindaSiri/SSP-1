<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$id = $_GET['id'];
?>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Delete</h1>
        <form action="/cb008920/deleteproduct" method="POST">
            <div>
                <label for="pid">Product ID</label><br>
                <input class="my_input" type="number" id="pid" name="pid" value="<?= htmlspecialchars($id) ?>">
                <p class="text-red"><?= $errors['pid'] ?? '' ?></p>
            </div>
            <p class="text-red"><?= $errors['productdelete'] ?? ''  ?></p>
            <button type="submit" class="my_btn mt-5">DELETE</button>
        </form>
    </div>
</div>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>