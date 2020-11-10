<?php 
require "Connect.php";
/*
            var id=x[0].innerHTML;
            var nombre=x[3].innerHTML;
                var paterno=x[4].innerHTML;
                var materno=x[5].innerHTML;
                var domicilio=x[6].innerHTML;
                var colonia=x[7].innerHTML;
                var municipio=x[8].innerHTML;
            var seccion=x[9].innerHTML;
            var telefono=x[10].innerHTML;
            var clave_elector=x[11].innerHTML;
            var id_red=x[12].innerHTML;
            var fecha_red=x[13].innerHTML;
*/
$id=$_POST["id"];
$nombre=$_POST["nombre"];
$paterno=$_POST["paterno"];
$materno=$_POST["materno"];
$domicilio=$_POST["domicilio"];
$colonia=$_POST["colonia"];
$municipio=$_POST["municipio"];
$seccion=$_POST["seccion"];
$telefono=$_POST["telefono"];
$clave_elector=$_POST["clave_elector"];
$id_red=$_POST["id_red"];
$fecha_red=$_POST["fecha_red"];

$sql="UPDATE promovidos SET nombre='$nombre',paterno='$paterno',materno='$materno',colonia='$colonia',municipio='$municipio',domicilio='$domicilio', seccion='$seccion', telefono='$telefono', clave_elector='$clave_elector', id_red='$id_red', fecha_red='$fecha_red' WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo "Listo! Los datos fueron modificados del domicilio: $domicilio id: $id";
} else {
    echo "Error updating record: " . $con->error;
}

?>