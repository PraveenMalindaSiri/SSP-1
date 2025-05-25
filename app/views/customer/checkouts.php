<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>

<!-- <pre><?php print_r($_SESSION['cart_total'] ?? []); ?></pre>
<pre><?php print_r($old ?? []); ?></pre>
<pre><?php print_r($errors ?? []); ?></pre> -->

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <form action="/cb008920/checkout" method="post">
            <div>
                <label for="cname">Cardholder Name</label><br>
                <input class="my_input" type="text" id="cname" name="cname" value="<?= htmlspecialchars($old['cname'] ?? '') ?>">
                <p class="text-red"><?= $errors['cname'] ?? '' ?></p>
            </div>
            <div>
                <label for="cnum">Card Number</label><br>
                <input class="my_input" type="number" id="cnum" name="cnum" value="<?= htmlspecialchars($old['cnum'] ?? '') ?>">
                <p class="text-red"><?= $errors['cnum'] ?? ''  ?></p>
            </div>
            <div>
                <label for="edate">Expiry Date</label><br>
                <input class="my_input" type="date" id="edate" name="edate" value="<?= htmlspecialchars($old['edate'] ?? '') ?>">
                <p class="text-red"><?= $errors['edate'] ?? ''  ?></p>
            </div>
            <div>
                <label for="secnum">CVV/ CVC</label><br>
                <input class="my_input" type="number" id="secnum" name="secnum" value="<?= htmlspecialchars($old['secnum'] ?? '') ?>">
                <p class="text-red"><?= $errors['secnum'] ?? ''  ?></p>
            </div>
            <button type="submit" class="my_btn mt-5">Pay now</button>
            <p class="text-red"><?= $errors['login'] ?? ''  ?></p>
        </form>
    </div>
</div>

<?php require_once(LAYOUT_PATH . "footer.php"); ?>