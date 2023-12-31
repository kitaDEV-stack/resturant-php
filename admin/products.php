<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);

    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_image/' . $image;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);
    if ($select_products->rowCount() > 0) {
        $message[] = 'product already exits';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'image size is too large';
        } else {
            $insert_products = $conn->prepare("INSERT INTO `products`(name,category,price,image) VALUES(?,?,?,?)");
            $insert_products->execute([$name, $category, $price, $image]);
            $message[] = 'new product added!';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ? ");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_image/' . $fetch_delete_image['image']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    header('location:products.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include '../components/admin_header.php' ?>


    <!--add products section start  -->
    <section class="add-products">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>add products</h3>
            <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
            <input type="number" required placeholder="enter product price" name="price" min="0" max="99999999" onkeypress="if(this.value.length == 10) return false;" class="box">
            <select name="category" id="" class="box">
                <option value="" disabled selected>--- select category ---</option>
                <option value="main dish">main dish</option>
                <option value="fast food">fast food</option>
                <option value="drinks">drinks</option>
                <option value="desserts">desserts</option>
            </select>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required class="box">
            <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>
    <!--add products section end  -->

    <!-- show products section start -->
    <section class="show-products" style="padding-top:0;">
        <div class="box-container">
            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
                while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>

                    <div class="box">
                        <img src="../uploaded_image/<?= $fetch_products['image']; ?>" alt="" class="flex">
                        <div class="flex">
                            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                            <div class="category"><?= $fetch_products['category']; ?></div>
                        </div>
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="flex-btn">
                            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
                            <a href="products.php?delete=<?= $fetch_products['id']; ?>" onclick="confirm('delete this product?')" class="delete-btn">delete</a>

                        </div>
                    </div>


            <?php
                }
            } else {
                echo '<p class="empty">there is no product added yet</p>';
            }


            ?>
        </div>
    </section>
    <!-- show products section end -->

    <!-- custom js file link  -->
    <script src="../js/admin_script.js"></script>
</body>

</html>