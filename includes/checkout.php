<?php

if(!isset($_SESSION['customer_email'])) {

    include("customer_login.php");

}
else {

    include("payment.php");

}

?>


