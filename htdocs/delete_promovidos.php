<?php 
require "Connect.php";

$id = $_POST["id"];
$domicilio = $_POST["domicilio"];


    
$sql="DELETE FROM promovidos WHERE id='$id'";
if ($con->query($sql) === TRUE) {
    echo "El usuario $domicilio fue eliminado";
} else {
    echo "Error updating record: " . $con->error;
}
?>