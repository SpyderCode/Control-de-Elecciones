<?php 
require "Connect.php";

//Crea una conexion a la base de datos
$con = mysqli_connect($server,$username,$password) or die("Error conectando al servidor");
mysqli_select_db($con,$database ) or die("No se pudo conectar a la base de datos");

/* 
            $id= $_POST["id"];
            x[0] id
            x[1] name
            x[2] email
            x[3] tel
            x[4] street
            x[5] numEx
            x[6] numIn
            x[7] Colony
            x[8] Municipal*/
$id=$_POST["id"];
$name=$_POST["name"];
$email=$_POST["email"];
$tel=$_POST["tel"];
$street=$_POST["street"];
$numEx=$_POST["numEx"];
$numIn=$_POST["numIn"];
$Colony=$_POST["Colony"];
$Municipal=$_POST["Municipal"];

$sql="UPDATE accounts SET username='$name',email='$email',Telefono='$tel',calle='$street',numExt='$numEx',numInt='$numIn',colonia='$Colony',municipio='$Municipal' WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo "Listo! Los datos fueron modificados del usuario: $name id: $id";
} else {
    echo "Error updating record: " . $con->error;
}

?>