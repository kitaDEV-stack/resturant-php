<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
  header('location:home.php');
};

  if(isset($_POST['submit'])){
    $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['street'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
    $address = filter_var($address,FILTER_SANITIZE_STRING);
    $update_address = $conn->prepare("UPDATE `users` SET address = ? WHERE id = ?");
    $update_address->execute([$address,$user_id]);
    $message[] = 'address has updated!';
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>update address</title>

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
      <h3>your address</h3>
      <input type="text" class="box" placeholder="flat no." required maxlength="50" name="flat" />
      <input type="text" class="box" placeholder="building no." required maxlength="50" name="building" />

      <input type="text" class="box" placeholder="street name" required maxlength="50" name="street" />

      <input type="text" class="box" placeholder="town name" required maxlength="50" name="town" />


      <input type="text" class="box" placeholder="city name" required maxlength="50" name="city" />

      <input type="text" class="box" placeholder="state name" required maxlength="50" name="state" />

      <input type="text" class="box" placeholder="country name" required maxlength="50" name="country" />

      <input type="number" class="box" placeholder="pin code" required max="999999" min="0" name="pin_code" />

      <input type="submit" value="save address" class="btn" name="submit" />

      <p>don't have an account? <a href="register.html">register now</a></p>
    </form>
  </section>

  <!-- *footer section start here -->
  <?php include 'components/footer.php'; ?>
  <!-- *footer section end here -->


  <script src="js/script.js"></script>
</body>

</html>