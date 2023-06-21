<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

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

    <div class="user-details">
      <div class="user">
        <img src="images/user-icon.png" alt="" />
        <p><i class="fas fa-user"></i><span><?= $fetch_profile['name']; ?></span></p>
        <p><i class="fas fa-phone"></i><?= $fetch_profile['number']; ?></p>
        <p><i class="fas fa-envelope"></i><?= $fetch_profile['email'];?></p>
        <a href="update_profile.php" class="btn">update info</a>
        <p class="address">
          <i class="fas fa-map-marker-alt"></i
          ><span>
            <?php
            if($fetch_profile['address'] == ''){
              echo 'please add your address';
            }else{
             echo $fetch_profile['address'];
            }
            
            ?>
          </span>
        </p>
        <a href="update_address.php" class="btn">update address</a>
      </div>
    </div>

    <!-- *footer section start here -->
    <?php include 'components/footer.php';?>
    <!-- *footer section end here -->

    <script src="js/script.js"></script>
  </body>
</html>
