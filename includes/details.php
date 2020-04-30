<?php

if(isset($_GET['prod_id'])) {

    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    $product_id = $_GET['prod_id'];

    $get_prods = "select * from products where product_id=" . $product_id . "";
    
    $run_prods = mysqli_query($con, $get_prods);
    
    while ($row_prod = mysqli_fetch_array($run_prods)) {     
        
        $prod_id = $row_prod['product_id'];
        $prod_title = $row_prod['product_title'];
        $prod_brand = $row_prod['product_brand'];
        $prod_cat = $row_prod['product_cat'];
        $prod_desc = $row_prod['product_desc'];
        $prod_keywords = $row_prod['product_keywords'];
        $prod_price = $row_prod['product_price'];
        $prod_image = $row_prod['product_image'];
        
        echo "
        <div style='display:inline-block;margin:10px;'> 
        <h3>$prod_title</h3>
        <img src='./admin_area/product_images/$prod_image' width='200' height='380' /> 
        <p>$prod_price €</p> 
       
        <p>$prod_desc</p> 
        
        <a href='index.php?prod_id=$prod_id' style='float:right'><button>Add to cart</button></a>  
        </div>    
        ";
        
    }
}