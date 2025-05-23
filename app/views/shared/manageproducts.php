<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();
?>

<?php
require_once(LAYOUT_PATH . "navbar_manageproducts.php");
?>

<!-- <pre><?php print_r($products); ?></pre> -->
<!-- <?= $_SESSION['user']['username'], $_SESSION['user']['role']  ?> -->

<table>
    <thead>
        <tr>
            <th>P-ID</th>
            <th>Name</th>
            <th>Edition</th>
            <th>Price</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($products) && is_array($products) && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['pid']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['type']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td>
                        <a href="/cb008920/updateproduct?id=<?= $product['pid'] ?>">Update</a> |
                        <a href="/cb008920/deleteproduct?id=<?= $product['pid'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No products found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>