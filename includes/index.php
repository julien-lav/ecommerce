<?php
    session_start();
    include("../functions/functions.php");
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>php scratch ecommerce</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="script.js"></script>
</head>
<body>
    <h1>Ecommerce</h1>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="all_products.php">Products</a></li>
        <li><a href="customer/my_account.php">My Account</a></li>
        <li><a href="index.php">Sign up</a></li>
        <li><a href="cart.php.php">Shopping Cart</a></li>
        <li><a href="index.php">Contact us</a></li>
    </ul>

    <form method="get" action="results.php" enctype="multipart/form-data">
        <input type="text" name="user_query" placeholder="Search a product"/>
        <input type="submit" name="search" value="Search"/>

    </form>

    <div>
        Welcome guest ! item :<?php totalItems() ?> price : <?php totalPrice() ?> <a href="cart.php">Go to Cart</a>
    </div>

    <?php 
      
        
        echo "<p> Categories </p>";
        getCats();

        echo "<br /><p> Brands </p>";
        

        getBrands();
    ?>
    <br />
    <br />
    <br />

    <?php     
        cart();
        getProducts();
    ?>

    <!-- unrder list ul -->

</body>
</html>