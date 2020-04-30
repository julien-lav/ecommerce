<?php 

$con = mysqli_connect("localhost", "root", "", "ecommerce");

function getCats() {
    global $con;

    $get_cats = "select * from categories";
    $run_cats = mysqli_query($con, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {        
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<a href='index.php?cat=$cat_id'><li>" . $cat_title . "</li></a>";        
    }
}

function getBrands() {
    global $con;

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($con, $get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)) {       
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

        echo "<a href='index.php?brand=$brand_id'><li>" . $brand_title . "</li></a>";
        
    }
}

function getProducts() {
    global $con;
    global $segment;

    if(!isset($_GET['cat']) && !isset($_GET['brand']) && !isset($_GET['search'])) {
        $get_prods = "select * from products order by RAND() LIMIT 0, 10";
    }
    elseif(isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        $get_prods = "select * from products where product_cat=" . $cat_id . "";
        $segment = "category";

    }
    elseif(isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $get_prods = "select * from products where product_brand=" . $brand_id . "";
        $segment = "brand";
    }
    elseif(isset($_GET['search'])) {
        $search_query = $_GET['user_query'];
        $get_prods = "select * from products where product_keywords like '%$search_query%' ";
        $segment = $search_query;
    }
    $run_prods = mysqli_query($con, $get_prods);
    $count_prods = mysqli_num_rows($run_prods);

    if($count_prods == 0) {
        echo "No product associated with " . $segment ."";
    } 
    else {

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
            <img src='./admin_area/product_images/$prod_image' width='100' height='180' /> 
            <p>$prod_price € // $prod_brand // $prod_cat // $prod_keywords //$segment </p> 
            <a href='details.php?prod_id=$prod_id' style='float:left'>Details</a>  
            <a href='index.php?add_cart=$prod_id' style='float:right'><button>Add to cart</button></a>  
            </div>    
            ";
        }    
    }    
}

function totalItems() {
    global $con;  
    $ip = getIp();

    $get_items = "select * from cart where ip_address='::1'";
    $run_items = mysqli_query($con, $get_items);
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
  
}

function totalPrice() {
    global $con;  
    $ip = getIp();
    $total = 0;

    $sel_price = "select * from cart where ip_address='::1'";
    $run_price = mysqli_query($con, $sel_price);

    while($row_prod = mysqli_fetch_array($run_price)) {
        
        $prod_id = $row_prod['product_id'];
        $prod_price = "select * from products where product_id=" . $prod_id . "";

        $run_prod_price = mysqli_query($con, $prod_price);

        
        
        while($row_prod_price = mysqli_fetch_array($run_prod_price)) {

            $product_price = array($row_prod_price['product_price']);
            $values = array_sum($product_price);
            $total += $values;

        }
    }
    echo "€" . $total;
}

function cart() {
    global $con;
    
    if(isset($_GET['add_cart'])) {
        $ip = getIp();
        $prod_id = $_GET['add_cart'];

        $check_product = "select * from cart where ip_address=" . "'" . $ip . "'" . " and product_id=" . $prod_id ."";

        $run_check = mysqli_query($con, $check_product);

        if(mysqli_num_rows($run_check) > 0) {
            //echo "<script>alert('Already added!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } 
        else {
            $insert_product = "insert into cart (product_id, ip_address) values ('$prod_id','$ip')";
            $run_prods_to_cart = mysqli_query($con, $insert_product);
            //echo "<script>alert('Added to cart!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}