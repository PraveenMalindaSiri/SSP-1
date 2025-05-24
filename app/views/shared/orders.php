<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<!-- 
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
                        <td><?= htmlspecialchars(string: $order['orderid']) ?></td>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td><?= htmlspecialchars($order['orderdate']) ?></td>
                        <td><?= htmlspecialchars($order['totalprice']) ?></td>
                        <td>
                            <a href="/cb008920/vieworder?id=<?= $order['orderid'] ?>" class="hover:text-skyblue">
                                <p>View</p>
                            </a>
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
</div> -->

<div class="mt-5 flex flex-col items-center">
    <div class=" mb-2 w-full flex flex-row justify-between items-center rounded-xl shadow-md p-4">
        <div>
            <p>OrderID</p>
        </div>
        <div class="flex md:flex-row flex-col w-[90%] justify-between items-center">
            <div>
                <p>
                    Username
                </p>
            </div>
            <div>
                <p>Order Date</p>
            </div>
            <div>
                <p>Total Price</p>
            </div>
        </div>
        <div>
            <p>View</p>
        </div>
    </div>
</div>

<?php if (isset($orders) && is_array($orders) && count($orders) > 0): ?>
    <?php foreach ($orders as $order): ?>
        <div class="mt-5 flex flex-col items-center">
            <div class="bg-gray-700 mb-2 w-full flex flex-row justify-between items-center text-white rounded-xl shadow-md p-4">
                <div>
                    <p><?= htmlspecialchars(string: $order['orderid']) ?></p>
                </div>
                <div class="flex md:flex-row flex-col w-[90%] justify-between items-center">
                    <div>
                        <p>
                            <?= htmlspecialchars($order['username']) ?>
                        </p>
                    </div>
                    <div>
                        <p><?= htmlspecialchars($order['orderdate']) ?></p>
                    </div>
                    <div>
                        <p>Rs.<?= htmlspecialchars($order['totalprice']) ?></p>
                    </div>
                </div>
                <div>
                    <a href="/cb008920/vieworder?id=<?= $order['orderid'] ?>" class="hover:text-skyblue">
                        <p>View</p>
                    </a>
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