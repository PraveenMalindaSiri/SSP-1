<?php require_once(LAYOUT_PATH . "navbar.php"); ?>


<div class="overflow-x-auto p-4">
    <table class="w-[100%] border-4 border-solid border-black border-collapse text-sm text-center" border="4">
        <thead class="bg-gray-100 text-xs uppercase">
            <tr>
                <th>Username</th>
                <th>FullName</th>
                <th>Role</th>
                <th>DoB</th>
                <th>Email</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (isset($users) && is_array($users) && count($users) > 0): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['fullname']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td><?= htmlspecialchars($user['date_of_birth']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="/cb008920/updateuserpassword?username=<?= $user['username'] ?>" class="hover:text-skyblue">
                                <p>Update password</p><br>
                            </a>
                            <a href="/cb008920/updateuserdetails?username=<?= $user['username'] ?>" class="hover:text-skyblue">
                                <p>Update details</p><br>
                            </a>
                            <a href="/cb008920/deleteuser?username=<?= $user['username'] ?>">
                                <p class="hover:text-skyblue">Delete</p><br>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><hr class="border-t border-gray-400 my-4"></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <a href="/cb008920/orders" class="text-xl text-center hover:text-skyblue">
            <p>All Customer Orders</p>
        </a>
    </div>
</div>

<?php require_once(LAYOUT_PATH . "footer.php"); ?>