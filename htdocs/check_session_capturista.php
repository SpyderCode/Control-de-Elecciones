<?php
require "Connect.php";
if(isset($_SESSION['loggedin'])&& ($_SESSION['loggedin'] == true)&&($_SESSION['Role']=='Capturista')){
}else{
    echo "redirect";
    exit;
}
?>