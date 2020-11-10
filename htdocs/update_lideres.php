<?php 
require "Connect.php";
/*
            var id=x[0].innerHTML;
            var name=x[1].innerHTML;
            var paterno=x[2].innerHTML;
            var materno=x[3].innerHTML;
            var domicilio=x[4].innerHTML;
            var colonia=x[5].innerHTML;
            var municipio=x[6].innerHTML;
            var seccion=x[7].innerHTML;
            var ocr=x[8].innerHTML;
            var telefono=x[9].innerHTML;
*/
$id=$_POST["id"];
$name=$_POST["name"];
$paterno=$_POST["paterno"];
$materno=$_POST["materno"];
$domicilio=$_POST["domicilio"];
$colonia=$_POST["colonia"];
$municipio=$_POST["municipio"];
$seccion=$_POST["seccion"];
$ocr=$_POST["ocr"];
$telefono=$_POST["telefono"];
    
$sql="UPDATE lideres SET Nombre='$name',paterno='$paterno',materno='$materno',domicilio='$domicilio',seccion='$seccion',municipio='$municipio',colonia='$colonia',ocr='$ocr',telefono='$telefono' WHERE id='$id'";
if ($con->query($sql) === TRUE) {
    echo "Listo! Los datos fueron modificados del usuario: $name id: $id";
} else {
    echo "Error updating record: " . $con->error;
}
$con->close();
?>