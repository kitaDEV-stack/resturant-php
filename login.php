<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
  $select_user->execute([$email, $pass]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);
  if ($select_user->rowCount() > 0) {
    $_SESSION['user_id'] = $row['id'];
          header('location:home.php');
  } else {
   $message[] = 'incorrect username or password';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- font-awsome cdn -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- google icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- css link -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!-- * header section start here -->
      <?php include 'components/user_header.php';?>
    <!-- * header section end here -->

    <section class="form-container">
      <form action="" method="post">
        <h3>login now</h3>
        <input
          type="email"
          name="email"
          required
          placeholder="enter your email"
          maxlength="50"
          oninput="this.value = this.value.replace(/\s/g, '')"
          class="box"
        />
        <input
          type="password"
          name="pass"
          required
          placeholder="enter your password"
          maxlength="50"
          oninput="this.value = this.value.replace(/\s/g, '')"
          class="box"
        />
        <input type="submit" value="login now" name="submit" class="btn" />
        <p>don't have an account? <a href="register.php" >register now</a></p>
      </form>
    </section>

    <!-- *footer section start here -->
    <?php include 'components/footer.php';?>
    <!-- *footer section end here -->


    <script src="js/script.js"></script>
  </body>
</html>
