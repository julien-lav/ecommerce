<?php 

include("../functions/functions.php");
include("./db.php");

?>

<div>
    <form method="post" action="" encypte="multipart/form-data">
        <table width="500" align="center" bgcolor="skyblue">
            <tr>
                <td><h2>Create an Account</h2></td>
            </tr>
            
            <tr>
                <td>Name:</td>
                <td><input type="text" name="c_name" placeholder="enter name" required></td>
            </tr>

            <tr>
                <td>Email:</td>
                <td><input type="text" name="c_email" placeholder="enter email" required></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="c_password" placeholder="enter password" required></td>
            </tr>

            <tr>
                <td>Address:</td>
                <td><input type="text" name="c_address" placeholder="enter address"></td>
            </tr>

            <tr>
                <td>Contact:</td>
                <td><input type="text" name="c_contact" placeholder="enter address"></td>
            </tr>

            <tr>
                <td>City:</td>
                <td><input type="text" name="c_city" placeholder="enter city"></td>
            </tr>

            <tr>
                <td>Country:</td>
                <td>
                    <select  name="c_country">
                        <option>Select a country</option>
                        <option>India</option>
                        <option>Japan</option>
                        <option>France</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Image:</td>
                <td><input type="file" name="c_image" placeholder="enter image"></td>
            </tr>

            <tr>
                <td><a href="checkout.php?forgot_pass">Forgot password?</a></td>
            </tr>

            <tr>
                <td><input type="submit" name="register" value="Register"></td>
            </tr>        
        </table>
        
        <center>
            <a href="customer_register.php">Register here</a>
        </center>   
    </form>
</div>

<?php 
    if(isset($_POST['register'])) {
        

        $ip = getIp();

        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_password = $_POST['c_password'];
        $c_address = $_POST['c_address'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact']; 
        $c_image = $_FILES['c_image']['tmp_name'];

        move_uploaded_file($c_image_tmp, "../customer/customer_images/$c_image");

        $insert_c = "insert into customers (customer_ip, customer_name, customer_email, customer_pass, customer_city, customer_country, customer_address, customer_contact, c_image ) values ('$ip', '$c_name', '$c_email', '$c_password', '$c_city', '$c_country', '$c_address', '$c_contact', '$c_image')";

        var_dump($insert_c);

        $run_c = mysqli_query($con, $insert_c);

        if($run_c) {
            echo "<script>alert('Added');</script>";
        }

    }
