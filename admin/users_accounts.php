<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_orders->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users accounts</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>
    <?php include '../components/admin_header.php'; ?>

    <!-- users accouts section start -->
    <section class="accounts">
        <h1 class="heading">admins accounts</h1>
        <div class="box-container">
            <div class="box">
                <p>register new admin</p>
                <a href="register_admin.php" class="option-btn">register</a>
            </div>

            <?php
            $select_account = $conn->prepare("SELECT * FROM `users`");
            $select_account->execute();
            if ($select_account->rowCount() > 0) {
                while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <p>user id : <span><?= $fetch_accounts['id']; ?></span></p>
                        <p>username : <span><?= $fetch_accounts['name']; ?></span></p>
                        <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="confirm('delete this account')">delete</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no accounts availble</p>';
            }
            ?>
        </div>
    </section>
    <!-- users accouts section end -->


    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>
</body>

</html>