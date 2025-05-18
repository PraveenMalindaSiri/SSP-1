<?php require_once(LAYOUT_PATH . "navbar.php"); ?>
<?php 
$id = $_GET['id'];
?>


<div class="flex flex-col items-center justify-center">
    <div class="my_form_div">
        <h1 class="text-2xl mb-5">Delete</h1>
        <form action="" method="POST">
            <div>
                <label for="pid">Product ID</label><br>
                <input class="my_input" type="number" id="pid" name="pid" required value="<?= $id ?>">
            </div>
            <button type="submit" class="my_btn mt-5">DELETE</button>
        </form>
    </div>
</div>



<?php require_once(LAYOUT_PATH . "footer.php"); ?>