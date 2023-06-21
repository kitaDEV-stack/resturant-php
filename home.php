<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

include 'components/add_cart.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>YumHouse</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- font-awsome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- google icon -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- css link -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- * header section start here -->
  <?php include 'components/user_header.php' ?>
  <!-- * header section end here -->

  <!-- *main section start here -->
  <section class="main">
    <div class="swiper main-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide">
          <div class="content">
            <span>order online</span>
            <h3>delicious pizza</h3>
            <a href="menu.php" class="btn">see menus</a>
          </div>
          <div class="image">
            <img src="images/home-img-1.png" alt="" />
          </div>
        </div>
        <div class="swiper-slide slide">
          <div class="content">
            <span>order online</span>
            <h3>chezzy burger</h3>
            <a href="menu.php" class="btn">see menus</a>
          </div>
          <div class="image">
            <img src="images/home-img-2.png" alt="" />
          </div>
        </div>
        <div class="swiper-slide slide">
          <div class="content">
            <span>order online</span>
            <h3>roasted chicken</h3>
            <a href="menu.php" class="btn">see menus</a>
          </div>
          <div class="image">
            <img src="images/home-img-3.png" alt="" />
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>
  <!-- *main section end here -->

  <!-- *category section starts -->

  <section class="category">
    <h1 class="title">food category</h1>
    <div class="box-container">
      <a href="category.php?category=fast food" class="box">
        <img src="images/cat-1.png" alt="" />
        <h3>fast food</h3>
      </a>
      <a href="category.php?category=main dish" class="box">
        <img src="images/cat-2.png" alt="" />
        <h3>main dishes</h3>
      </a>
      <a href="category.php?category=drinks" class="box">
        <img src="images/cat-3.png" alt="" />
        <h3>drinks</h3>
      </a>
      <a href="category.php?category=desserts" class="box">
        <img src="images/cat-4.png" alt="" />
        <h3>desserts</h3>
      </a>
    </div>
  </section>

  <!-- *category section end -->

  <!-- *home products section starts -->

  <section class="products">
    <h1 class="title">latest dishes</h1>
    <div class="box-container">
      <?php

      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if ($select_products->rowCount() > 0) {
        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {

      ?>

          <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']?>">
            <a href="quick_view.php?pid=<?= $fetch_products['id']?>" class="fas fa-eye"></a>
            <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
            <img src="uploaded_image/<?= $fetch_products['image']?>" alt="" />
            <a href="category.php?category=<?= $fetch_products['category']?>" class="cat">fast food</a>
            <div class="name"><?= $fetch_products['name']?></div>
            <div class="flex">
              <div class="price"><span>$</span><?= $fetch_products['price']?></div>
              <input type="number" class="qty" name="qty" min="1" max="99" value="1" maxlength="2" />
            </div>
          </form>


      <?php
        }
      } else {

        echo '<p class="empty">no product added yet!</p>';

      }


      ?>
    </div>

    <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
    </div>
  </section>

  <!-- *home products section end -->

  <!-- *footer section start here -->
  <?php include 'components/footer.php'; ?>
  <!-- *footer section end here -->

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <script src="js/script.js"></script>

  <script>
    var swiper = new Swiper(".main-slider", {
      loop: true,
      effect: "flip",
      grabCursor: true,
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>
</body>

</html>