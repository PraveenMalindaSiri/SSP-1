<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>FullName</th>
            <th>Role</th>
            <th>DoB</th>
            <th>Email</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($users) && is_array($users) && count($users) > 0): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['fullname']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td><?= htmlspecialchars($user['date_of_birth']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="/cb008920/updateuserpassword?username=<?= $user['username'] ?>">Update password</a>
                        <a href="/cb008920/updateuserdetails?username=<?= $user['username'] ?>">Update details</a>
                        <a href="/cb008920/deleteuser?username=<?= $user['username'] ?>">delete</a>
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

<div class="my_form_div">
    <a href="/cb008920/orders" class="text-xl text-center hover:text-skyblue">
        <p>All Customer Orders</p>
    </a>
</div>


<?php require_once(LAYOUT_PATH . "footer.php"); ?>