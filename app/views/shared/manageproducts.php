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

<!-- <div class="overflow-x-auto p-4">
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
</div> -->

<div class="mt-5 flex flex-col items-center">
    <div class="mb-2 w-full flex flex-row justify-between items-center rounded-xl shadow-md p-4">
        <div>
            <p>Product ID</p>
        </div>
        <div>
            <p>Product name</p>
        </div>
        <div class="flex md:flex-row flex-col w-[60%] justify-evenly gap-4 items-center">
            <div>
                <p>Edition</p>
            </div>
            <div>
                <p class="font-semibold">Price</p>
            </div>
        </div>
        <div>
            <p>Manage</p>
        </div>
    </div>
</div>

<?php if (isset($products) && is_array($products) && count($products) > 0): ?>
    <?php foreach ($products as $product): ?>
        <div class="mt-5 flex flex-col items-center">
            <div class="bg-gray-700 mb-2 w-full flex flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
                <div>
                    <p><?= htmlspecialchars($product['pid']) ?></p>
                </div>
                <div>
                    <a href="/cb008920/productview?pid=<?= $product['pid'] ?>" class="font-semibold hover:text-skyblue">
                        <p><?= htmlspecialchars($product['name']) ?></p>
                    </a>
                </div>
                <div class="flex md:flex-row flex-col w-[60%] justify-evenly gap-4 items-center">
                    <div>
                        <p><?= htmlspecialchars($product['type']) ?></p>
                    </div>
                    <div>
                        <p class="font-semibold">Rs.<?= htmlspecialchars($product['price']) ?></p>
                    </div>
                </div>
                <div>
                    <a href="/cb008920/updateproduct?id=<?= $product['pid'] ?>">
                        <img src="/cb008920/public/assets/images/main/change.png" alt="editing" width="30">
                        <!-- <p class="hover:text-skyblue">Update</p> -->
                    </a><br>
                    <a href="/cb008920/deleteproduct?id=<?= $product['pid'] ?>">
                        <img src="/cb008920/public/assets/images/main/trash.png" alt="deleting" width="30">
                        <!-- <p class="hover:text-skyblue">Delete</p> -->
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>no paroduct</p>
<?php endif; ?>

<?php require_once(LAYOUT_PATH . "footer.php"); ?>