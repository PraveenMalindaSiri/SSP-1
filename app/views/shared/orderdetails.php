<?php require_once(LAYOUT_PATH . "navbar.php"); ?>

<table>
    <thead>
        <tr>
            <th>Order-ID</th>
            <th>Product</th>
            <th>Quantity/Code</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
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


<?php require_once(LAYOUT_PATH . "footer.php"); ?>