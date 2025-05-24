<?php require_once(LAYOUT_PATH . "navbar.php"); ?>

<!-- <div class="overflow-x-auto p-4">
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
</div> -->

<div class="mt-5 flex flex-col items-center">
    <div class=" mb-2 w-full flex flex-row justify-between items-center rounded-xl shadow-md p-4">
        <div>
            <p>Order ID</p>
        </div>
        <div>
            <p>
                Product Name
            </p>
        </div>
        <div>
            <p>Digital Code/Amount</p>
        </div>
        <div>
            <p>Unit Price</p>
        </div>
    </div>
</div>


<?php if (isset($orderDetails) && is_array($orderDetails) && count($orderDetails) > 0): ?>
    <?php foreach ($orderDetails as $order): ?>
        <div class="mt-5 flex flex-col items-center">
            <div class="bg-gray-700 mb-2 w-full flex flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
                <div>
                    <p><?= htmlspecialchars(string: $order['orderid']) ?></p>
                </div>
                <div>
                    <p>
                        <?= htmlspecialchars($order['name']) ?>
                    </p>
                </div>
                <div>
                    <?php if ($order['is_Digital']): ?>
                        <p><?= htmlspecialchars($order['code']) ?></p>
                    <?php else: ?>
                        <p><?= htmlspecialchars($order['amount']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <p>Rs.<?= htmlspecialchars($order['price']) ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">No Orders found.</td>
    </tr>
<?php endif; ?>

<?php require_once(LAYOUT_PATH . "footer.php"); ?>