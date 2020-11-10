<?php 
require "Connect.php";

//Crea una conexion a la base de datos
$con = mysqli_connect($server,$username,$password) or die("Error conectando al servidor");
mysqli_select_db($con,$database ) or die("No se pudo conectar a la base de datos");

$id = $_POST["id"];
$name = $_POST["name"];

$sql="DELETE FROM accounts WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo "El usuario $name fue eliminado";
} else {
    echo "Error updating record: " . $con->error;
}
?>