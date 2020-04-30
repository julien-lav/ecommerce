<?php
 include("../functions/functions.php");
 $_SESSION['quantity'] = 1;
 ?>

<form action="./cart.php" method="post" enctype="multipart/form-data">
    <table align="center" width="700" bgcolor="skyblue" style="padding:10px;">
        <tr align="center">
            <td colspan="5">
                <h2>Cart</h2>
            </td>
        </tr>
        <tr align="center">
            <th>Remove</th>
            <th>Product(s)</th>
            <th>Qty</th>
            <th>Total Price</th>
        </tr>
        <?php
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
                    $product_title = $row_prod_price['product_title'];
                    $product_image = $row_prod_price['product_image'];
                    
                    //$product_quantity = $row_prod_price['product_quantity'];
                    
                    $single_price = $row_prod_price['product_price'];

                    $values = array_sum($product_price);
                    $total += $values;
          
                      
          
        ?>

        <tr align="center">
            <td>
                <input type="checkbox" name="remove[]" value="<?php echo $prod_id ?>">
            </td>
            <td>
                <?php echo $product_title ?><br />
                <img src="../admin_aera/product_images/<?php echo $product_image; ?>" alt="" width="100">
            </td>
            <td>
                <input type="text" size="4" name="quantity" value="<?php echo $_SESSION['quantity']; ?>" />
                <?php 
                if(isset($_POST['update_cart'])) {
                    $quantity = $_POST['quantity'];

                    $update_quantity = "update cart set quantity='$quantity'";
                    $run_quantity = mysqli_query($con, $update_quantity);

                    $_SESSION['quantity'] = $quantity;

                    $total = $total * $quantity; 

                }
                ?>
            </td>
            <td>
                <?php echo "<b>Sub total : </b>" . $single_price ?><br />
            </td>

        </tr>
        <tr>
            <td colspan="5" align="right">
                <?php    
                        }
                    } 
                    echo "€" . $total;
                ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit"name="update_cart" value="Update Cart"></td>
            <td><input type="submit"name="continue" value="Continue shopping"></td>
            <td><a href="checkout.php"><button>Checkout</button></a></td>
        </tr>
    </table>
</form> 

<?php 
    function updateCart() {
        global $con;
        $ip = getIp();
    

        if(isset($_POST['update_cart'])) {
            if(isset($_POST['remove'])) {
                foreach($_POST['remove'] as $remove_id) {

                    $delete_product = "delete from cart where product_id =" . $remove_id . " and ip_address=". "'" . $ip . "'" .""; 
                    
                    $run_delete = mysqli_query($con, $delete_product);
                
                    if($run_delete) {
                        echo "<script>window.open('cart.php', '_self')</script>";
                    }
                    
                }
            }
        
        }
        if(isset($_POST['continue'])) {
            echo "<script>window.open('index.php', '_self')</script>";
        }
       
    }

    echo @$up_cart = updateCart();


