<?php 
require "Connect.php";

$id = $_POST["id"];
$name = $_POST["name"];


    
$sql="DELETE FROM lideres WHERE id='$id'";
if ($con->query($sql) === TRUE) {
    echo "El usuario $name fue eliminado";
} else {
    echo "Error updating record: " . $con->error;
}
?>