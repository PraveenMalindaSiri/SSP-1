<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php
require_once APP_PATH . 'core/Session.php';
$session = new Session();
$session->start();
?>

<?php if ($session->isLoggedIn() && $session->isSeller())
    require_once(LAYOUT_PATH . "navbar_manageproducts.php");
?>

<table>
    <thead>
        <tr>
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
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['type']) ?></td>
            <td><?= htmlspecialchars($product['price']) ?></td>
            <td>
                <a href="/cb008920/public/product/update?id=<?= $product['id'] ?>">Update</a> |
                <a href="/cb008920/public/product/delete?id=<?= $product['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No products found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>