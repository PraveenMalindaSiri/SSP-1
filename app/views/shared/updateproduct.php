<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);

$id = $_GET['id'];
?>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Update</h1>
        <form action="/cb008920/updateproduct" method="POST">
            <div>
                <label for="pid">Product ID</label><br>
                <input class="my_input" type="number" id="pid" name="pid" value="<?= $id ?>">
                <p class="text-red"><?= $errors['pid'] ?? '' ?></p>
            </div>
            <div>
                <label for="name">Name</label><br>
                <input class="my_input" type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                <p class="text-red"><?= $errors['name'] ?? '' ?></p>
            </div>
            <div>
                <label for="genre">Genre</label><br>
                <input class="my_input" type="text" id="genre" name="genre" value="<?= htmlspecialchars($old['genre'] ?? '') ?>">
                <p class="text-red"><?= $errors['genre'] ?? '' ?></p>
            </div>
            <div>
                <label for="duration">Duration</label><br>
                <input class="my_input" type="number" id="duration" name="duration" value="<?= htmlspecialchars($old['duration'] ?? '') ?>">
                <p class="text-red"><?= $errors['duration'] ?? '' ?></p>
            </div>
            <div>
                <label for="platform">Platform</label><br>
                <input class="my_input" type="text" id="platform" name="platform" value="<?= htmlspecialchars($old['platform'] ?? '') ?>">
                <p class="text-red"><?= $errors['platform'] ?? '' ?></p>
            </div>
            <div>
                <label for="price">Price</label><br>
                <input class="my_input" type="number" id="price" name="price" value="<?= htmlspecialchars($old['price'] ?? '') ?>">
                <p class="text-red"><?= $errors['price'] ?? '' ?></p>
            </div>
            <div>
                <label for="ReleaseDate">Released Date</label><br>
                <input class="my_input" type="date" id="ReleaseDate" name="ReleaseDate" value="<?= htmlspecialchars($old['ReleaseDate'] ?? '') ?>">
                <p class="text-red"><?= $errors['ReleaseDate'] ?? '' ?></p>
            </div>
            <div>
                <label for="age">Age</label><br>
                <input class="my_input" type="number" id="age" name="age" value="<?= htmlspecialchars($old['age'] ?? '') ?>">
                <p class="text-red"><?= $errors['age'] ?? '' ?></p>
            </div>
            <div>
                <label for="size">Size</label><br>
                <input class="my_input" type="number" id="size" name="size" value="<?= htmlspecialchars($old['size'] ?? '') ?>">
                <p class="text-red"><?= $errors['size'] ?? '' ?></p>
            </div>
            <div>
                <label for="description">Description</label><br>
                <textarea class="my_input" id="description" name="description"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                <p class="text-red"><?= $errors['description'] ?? '' ?></p>
            </div>
            <p class="text-red"><?= $errors['productupdate'] ?? ''  ?></p>
            <p class="text-green"><?= $success['productupdate'] ?? ''  ?></p>
            <button type="submit" class="my_btn mt-5">UPDATE</button>
        </form>
    </div>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>