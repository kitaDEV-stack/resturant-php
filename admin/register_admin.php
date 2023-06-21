<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
    $select_admin->execute([$name]);
    if ($select_admin->rowCount() > 0) {
        $message[] = 'username already exit';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not match!';
        } else {
            $insert_admin = $conn->prepare("INSERT INTO `admin`(name,password) VALUES(?,?)");
            $insert_admin->execute([$name, $cpass]);
            $message[] = 'registered successfully';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin register</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include '../components/admin_header.php'; ?>
    <!-- admin register form start -->
    <section class="form-container">
        <form action="" method="post">
            <h3>register now</h3>
            <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" maxlength="20" required placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" name="submit" class="btn" value="register now">
        </form>
    </section>
    <!-- admin register form end -->


    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>
</body>

</html>