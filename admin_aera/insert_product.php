<?php 
    include("./includes/db.php");
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

    <form method="post" action="insert_product.php" enctype="multipart/form-data">

        <table align="center" width="750" border="2" bgcolor="orange">
            <tr align="center">
                <td colspan="8"><h3>Product</h3></td>
            </tr>
            <tr>
                <td>Product title:</td>
                <td><input type="text" name="product_title"></td>
            </tr>         
            <tr>
                <td>Product categorie:</td>
                <td>
                    <select name="product_cat">
                        <?php
                             $get_cats = "select * from categories";

                             $run_cats = mysqli_query($con, $get_cats);
                         
                             while ($row_cats = mysqli_fetch_array($run_cats)) {
                                 
                                 $cat_id = $row_cats['cat_id'];
                                 $cat_title = $row_cats['cat_title'];
                         
                                 echo "<option value='$cat_id'>" . $cat_title . "</opption>";
                                 
                             }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Product brand:</td>
                <td>
                    <select name="product_brand">
                        <?php
                        $get_brands = "select * from brands";
                        $run_brands = mysqli_query($con, $get_brands);
                    
                        while ($row_brands = mysqli_fetch_array($run_brands)) {       
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];
                    
                            echo "<option value='$brand_id'>" . $brand_title . "</option>";
                            
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Product image:</td>
                <td><input type="file" name="product_image"></td>
            </tr>
            <tr>
                <td>Product description:</td>
                <td><textarea id="textarea" type="text" name="product_desc" cols="20" rows="10"></textarea></td>
            </tr> <tr>
                <td>Product price:</td>
                <td><input type="text" name="product_price"></td>
            </tr>
            <tr>
                <td>Product keywords:</td>
                <td><input type="text" name="product_keywords"></td>
            </tr>
            <tr>
                <td align="center" colspan="8">
                    <input type="submit" name="insert_product" value="Insert"/>
                </td>
            </tr>
        </table>


    </form>

    <!-- unrder list ul -->

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#textarea'
  });
</script>

</body>
</html>

<?php

    if(isset($_POST['insert_product'])) {

        $product_title = $_POST['product_title'];
        $product_brand = $_POST['product_brand'];
        $product_cat = $_POST['product_cat'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $product_price = $_POST['product_price'];

        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($product_image_tmp, "product_images/$product_image");

        $insert_product = "insert into products 
        (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) 
        values ('$product_cat', '$product_brand', '$product_title', '$product_price', '$product_desc', '$product_image', '$product_keywords')";

        $insert_pro = mysqli_query($con, $insert_product);

        if($insert_pro) {
            echo "<script>alert('ok')</script>";
            echo "<script>window.open('insert_product','_self')</script>";
        }

    }   