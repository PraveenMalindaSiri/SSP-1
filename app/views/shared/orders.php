<?php require_once(LAYOUT_PATH . "navbar.php"); ?>



<div class="overflow-x-auto p-4">
    <table class="w-[100%] border-2 border-black text-sm text-center">
        <thead class="bg-gray-100 text-xs uppercase">
            <tr>
                <th>Order-ID</th>
                <th>Username</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (isset($orders) && is_array($orders) && count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['orderid']) ?></td>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td><?= htmlspecialchars($order['orderdate']) ?></td>
                        <td><?= htmlspecialchars($order['totalprice']) ?></td>
                        <td>
                            <a href="/cb008920/vieworder?id=<?= $order['orderid'] ?>" class="hover:text-skyblue"><p>View</p></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>




<?php require_once(LAYOUT_PATH . "footer.php"); ?>