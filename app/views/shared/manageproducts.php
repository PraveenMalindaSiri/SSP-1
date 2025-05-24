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

<div class="overflow-x-auto p-4">
    <table class="w-[100%] border border-black text-sm text-center border-collapse">
        <thead class="bg-gray-100 text-xs uppercase">
            <tr>
                <th>P-ID</th>
                <th>Name</th>
                <th>Edition</th>
                <th>Price</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (isset($products) && is_array($products) && count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['pid']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['type']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?></td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="/cb008920/updateproduct?id=<?= $product['pid'] ?>">
                                <p class="hover:text-skyblue">Update</p>
                            </a>
                            <a href="/cb008920/deleteproduct?id=<?= $product['pid'] ?>">
                                <p class="hover:text-skyblue">Delete</p>
                            </a>
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
</div>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>