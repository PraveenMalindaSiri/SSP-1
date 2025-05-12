<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php require_once(LAYOUT_PATH . "navbar_manageproducts.php"); ?>
<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();
?>

<?php if ($session->isLoggedIn() && $session->isSeller())
'<a href="../shared/updateproduct.php">update details</a><br>
<a href="../shared/deleteproduct.php">delete</a>'
?>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>