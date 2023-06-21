<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

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

<!-- heading start here -->
  <div class="heading">
    <h3>about us</h3>
    <p><a href="home.html">home</a><span> / about</span></p>
  </div>
<!-- heading end here -->

<!-- *about section start here -->
<section class="about">
  <div class="row">
    <div class="image">
      <img src="images/about-img.svg" alt="">
    </div>

    <div class="content">
      <h3>why choose us?</h3>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fuga temporibus iusto a autem ullam architecto delectus ad excepturi, tenetur illum maxime suscipit, eligendi nisi sed omnis molestiae ratione non provident voluptatum eos? Voluptas nihil, aperiam repellat nam nesciunt reiciendis dolorum tenetur quis fugiat illo necessitatibus expedita totam, eum asperiores quam repellat perspiciatis.</p>
      <a href="menu.html" class="btn">our menu</a>
    </div>
  </div>
</section>
<!-- *about section end here -->

<!-- *step section start here -->
<section class="steps">
  <h1 class="title">simple steps</h1>
  <div class="box-container">
    <div class="box">
      <img src="images/step-1.png" alt="">
      <h3>choose order</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, repellendus!</p>
    </div>
    <div class="box">
      <img src="images/step-2.png" alt="">
      <h3>fast delivery</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, repellendus!</p>
    </div>
    <div class="box">
      <img src="images/step-3.png" alt="">
      <h3>enjoy food</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, repellendus!</p>
    </div>
  </div>
</section>
<!-- *step section end here -->

<!-- *review section start here -->
<section class="review">
  <div class="swiper review-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide slide">
        <img src="images/pic-1.png" alt="">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut nostrum harum sint, minima quia voluptatibus aliquam numquam non! Alias, delectus!</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <h3>person</h3>
      </div>
      <div class="swiper-slide slide">
        <img src="images/pic-2.png" alt="">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut nostrum harum sint, minima quia voluptatibus aliquam numquam non! Alias, delectus!</p>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
        </div>
        <h3>person</h3>
        </div>
        <div class="swiper-slide slide">
          <img src="images/pic-3.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut nostrum harum sint, minima quia voluptatibus aliquam numquam non! Alias, delectus!</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <h3>person</h3>
        </div>
        <div class="swiper-slide slide">
          <img src="images/pic-4.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut nostrum harum sint, minima quia voluptatibus aliquam numquam non! Alias, delectus!</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <h3>person</h3>
        </div>
        <div class="swiper-slide slide">
          <img src="images/pic-5.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut nostrum harum sint, minima quia voluptatibus aliquam numquam non! Alias, delectus!</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <h3>person</h3>
        </div>
        <div class="swiper-slide slide">
          <img src="images/pic-6.png" alt="">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut nostrum harum sint, minima quia voluptatibus aliquam numquam non! Alias, delectus!</p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <h3>person</h3>
        </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>
<!-- *review section end here -->













































  <!-- *footer section start here -->
  <?php include 'components/footer.php'; ?>
  <!-- *footer section end here -->

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <script src="js/script.js"></script>

  <script>
    var swiper = new Swiper(".review-slider", {
      loop:true,
      spaceBetween: 20,
      grabCursor: true,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>
</body>
</html>