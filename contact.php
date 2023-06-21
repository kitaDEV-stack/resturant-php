<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

if (isset($_POST['send'])) {
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $msg = $_POST['msg'];
  $msg = filter_var($msg, FILTER_SANITIZE_STRING);

  $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND number = ?AND email = ? AND message = ?");
  $select_message->execute([$name, $number, $email, $msg]);

  if ($select_message->rowCount() > 0) {
    $message[] = 'already sent message';
  } else {
    $insert_message = $conn->prepare("INSERT INTO `messages`(user_id,name,number,email,message) VALUES(?,?,?,?,?)");
    $insert_message->execute([$user_id, $name, $number, $email, $msg]);
    $message[] = 'sent message successfully';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>contact</title>

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

  <div class="heading">
    <h3>contact us</h3>
    <p><a href="home.html">home</a><span> / contact</span></p>
  </div>

  <!-- *contact section start here -->

  <section class="contact">
    <div class="row">
      <div class="image">
        <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
        <h3>tell us something</h3>
        <input type="text" name="name" maxlength="50" class="box" placeholder="enter your name" required>
        <input type="text" name="number" min="0" max="99999" class="box" placeholder="enter your number" required>
        <input type="email" name="email" maxlength="50" class="box" placeholder="enter your email" required>
        <textarea name="msg" class="box" placeholder="enter your message" maxlength="500" cols="30" rows="10"></textarea>
        <input type="submit" value="send message" name="send" class="btn">
      </form>
    </div>
  </section>

  <!-- *contact section end here -->









  <!-- *footer section start here -->
  <?php include 'components/footer.php' ?>
  <!-- *footer section end here -->

  <script src="js/script.js"></script>
</body>

</html>