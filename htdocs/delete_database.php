<?php 
require "Connect.php";

$sql="DELETE from accounts WHERE Role != 'Admin' OR Role is null";
$sql4="DELETE from lideres";
$sql3="DELETE from promotores";
$sql2="DELETE from promovidos";

if (($con->query($sql) === TRUE)and($con->query($sql2) === TRUE)and($con->query($sql3) === TRUE)and($con->query($sql4) === TRUE)) {
    echo "Listo! Ya se borro la base de datos!";
} else {
    echo "Error updating record: " . $con->error;
}


?>