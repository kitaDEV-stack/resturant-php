<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);

  if (!empty($name)) {
    $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
    $update_name->execute([$name, $user_id]);
    $message[] = 'your name has updated';
  }

  if (!empty($email)) {
    $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_email->execute([$email]);
    if ($select_email->rowCount() > 0) {
      $message[] = 'email already used';
    } else {
      $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
      $update_email->execute([$email, $user_id]);
      $message[] = 'your email has updated';
    }
  }

  if (!empty($number)) {
    $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
    $select_number->execute([$number]);
    if ($select_number->rowCount() > 0) {
      $message[] = 'number already used';
    } else {
      $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
      $update_number->execute([$number, $user_id]);
      $message[] = 'your number has updated';
    }
  }

  $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
  $select_prev_pass->execute([$user_id]);
  $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
  $prev_pass = $fetch_prev_pass['password'];
  $old_pass = sha1($_POST['old-pass']);
  $old_pass = filter_var($old_pass,FILTER_SANITIZE_STRING);
  $new_pass = sha1($_POST['new-pass']);
  $new_pass = filter_var($new_pass,FILTER_SANITIZE_STRING);
  $confirm_pass = sha1($_POST['confirm-pass']);
  $confirm_pass = filter_var($confirm_pass,FILTER_SANITIZE_STRING);

  if($old_pass != $empty_pass){
    if($old_pass != $prev_pass){
      $message[] = 'your old password is incorrect';
    }elseif($new_pass != $confirm_pass){
      $message[] = 'confirm password not match';
    }else{
      if($new_pass != $empty_pass){
        $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
        $update_pass->execute([$confirm_pass,$user_id]);
        $message[] = 'your password has updated';
      }else{
        $message[] = 'please enter a new password';
      }
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>update profile</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- google icon -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <!-- header section starts  -->
  <?php include 'components/user_header.php'; ?>
  <!-- header section ends -->

  <section class="form-container">
    <form action="" method="post">
      <h3>update profile</h3>
      <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50" class="box" />
      <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box" />
      <input type="number" name="number" placeholder="<?= $fetch_profile['number']; ?>" maxlength="50" class="box" />
      <input type="password" name="old-pass" placeholder="Enter your old password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box" />
      <input type="password" name="new-pass" placeholder="Enter you new password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box" />
      <input type="password" name="confirm-pass" placeholder="Confirm your password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box" />
      <input type="submit" value="update now" name="submit" class="btn" />
    </form>
  </section>

  <!-- *footer section start here -->
  <?php include 'components/footer.php'; ?>
  <!-- *footer section end here -->

  <script src="js/script.js"></script>
</body>

</html>