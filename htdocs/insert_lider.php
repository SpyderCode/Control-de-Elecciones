<?php 
require "Connect.php";
/*nomlid:nomlid, apelidp:apelidp, apelidm:apelidm, domicilio:domicilio, colonia:colonia, municipio:municipio, seccion:seccion, ocr:ocr, telefono:telefono*/

$nomlid=$_POST["nomlid"];
$apelidp=$_POST["apelidp"];
$apelidm=$_POST["apelidm"];
$domicilio=$_POST["domicilio"];
$colonia=$_POST["colonia"];
$municipio=$_POST["municipio"];
$seccion=$_POST["seccion"];
$ocr=$_POST["ocr"];
$telefono=$_POST["telefono"];

$sql="INSERT INTO lideres (Nombre, paterno, materno, domicilio, colonia, municipio, seccion, ocr, telefono) VALUES ('$nomlid','$apelidp','$apelidm','$domicilio','$colonia','$municipio','$seccion','$ocr','$telefono')";

if ($con->query($sql) === TRUE) {
    echo "Listo! El lider fue ingresado";
} else {
    echo "Error updating record: " . $con->error;
}

?>