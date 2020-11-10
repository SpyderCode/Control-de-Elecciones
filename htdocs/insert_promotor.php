<?php 
require "Connect.php";
/*nomlid:nomlid, apelidp:apelidp, apelidm:apelidm, nomprom:nomprom, apepromp:apepromp, apepromm:apepromm, domicilio:domicilio, colonia:colonia, municipio:municipio, seccion:seccion, ocr:ocr, telefono:telefono*/

$nomlid=$_POST["nomlid"];
$apelidp=$_POST["apelidp"];
$apelidm=$_POST["apelidm"];

$nomprom=$_POST["nomprom"];
$apepromp=$_POST["apepromp"];
$apepromm=$_POST["apepromm"];

$domicilio=$_POST["domicilio"];
$colonia=$_POST["colonia"];
$municipio=$_POST["municipio"];
$seccion=$_POST["seccion"];
$ocr=$_POST["ocr"];
$telefono=$_POST["telefono"];

$test=mysqli_query($con,"select id from lideres where lower('$nomlid')=lower(Nombre) AND lower('$apelidp')=lower(paterno) AND lower('$apelidm')=lower(materno)") ; 
$idk=mysqli_fetch_array($test) or die("ERROR: El lider que ingreso no existe, verifique que los datos esten correctos.");
$liderId=$idk["id"];

$sql="Insert into promotores (Nombre, paterno, materno, id_lider, domicilio, colonia, municipio, seccion, ocr, telefono) values ('$nomprom','$apepromp','$apepromm','$liderId','$domicilio',upper('$colonia'),upper('$municipio'),'$seccion','$ocr','$telefono')";
    
    if ($con->query($sql) === TRUE) {
    echo "Listo! El promotor fue ingresado";
} else {
    echo "Error updating record: " . $con->error;
}
  






?>