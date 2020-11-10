<?php 
require "Connect.php";


$id= $_POST["personid"];
$role=$_POST["role"];

$sql="UPDATE accounts SET Role='$role' WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo "Listo! ID:".$id." ahora es: ".$role;
} else {
    echo "Error updating record: " . $con->error;
}

$con->close();






?>