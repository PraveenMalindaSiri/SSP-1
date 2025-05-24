<?php require_once(LAYOUT_PATH . "navbar.php"); ?>

<div class="overflow-x-auto p-4">
    <table class="w-[100%] border-2 border-black text-sm text-center">
        <thead class="bg-gray-100 text-xs uppercase">
            <tr>
                <th>Order-ID</th>
                <th>Product</th>
                <th>Quantity/Code</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (isset($orderDetails) && is_array($orderDetails) && count($orderDetails) > 0): ?>
                <?php foreach ($orderDetails as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['orderid']) ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <?php if ($order['is_Digital']): ?>
                            <td><?= htmlspecialchars($order['code']) ?></td>
                        <?php else: ?>
                            <td><?= htmlspecialchars($order['amount']) ?></td>
                        <?php endif; ?>
                        <td><?= htmlspecialchars($order['price']) ?></td>
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