<?php
require "Connect.php";
if(isset($_SESSION['loggedin'])&& ($_SESSION['loggedin'] == true)&&($_SESSION['Role']=='Admin')){
}else{
    echo "redirect";
    exit;
}
?>