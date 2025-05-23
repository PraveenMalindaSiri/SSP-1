<?php require_once(LAYOUT_PATH . "navbar.php"); ?>



<table>
    <thead>
        <tr>
            <th>Order-ID</th>
            <th>Username</th>
            <th>Date</th>
            <th>Total Price</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($orders) && is_array($orders) && count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= htmlspecialchars($order['orderid']) ?></td>
            <td><?= htmlspecialchars($order['username']) ?></td>
            <td><?= htmlspecialchars($order['orderdate']) ?></td>
            <td><?= htmlspecialchars($order['totalprice']) ?></td>
            <td>
                <a href="/cb008920/public/vieworder?id=<?= $order['orderid'] ?>">View</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No Orders found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>




<?php require_once(LAYOUT_PATH . "footer.php"); ?>