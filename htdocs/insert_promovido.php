<?php 
require "Connect.php";
//$id=$_POST["id"];

//DATOS
$idr=$_POST["idr"];
$fechared=$_POST["fechared"];
$nomprom=$_POST["nomprom"];
$apepromp=$_POST["apepromp"];
$apepromm=$_POST["apepromm"];

//ROW DATA
$nombre=$_POST["nombre"];
$paterno=$_POST["paterno"];
$materno=$_POST["materno"];
$domicilio=$_POST["domicilio"];
$colonia=$_POST["colonia"];
$municipio=$_POST["municipio"];
$seccion=$_POST["seccion"];
$telefono=$_POST["telefono"];
$ocr=$_POST["ocr"];

//LOGIC
$sql="Insert into promovidos (id_promotor, nombre, paterno, materno, domicilio, colonia, municipio, seccion, telefono, clave_elector, id_red, fecha_red) VALUES ((";

$select="Select id as id_promotor from promotores where lower('$nomprom')=lower(Nombre) AND lower('$apepromp')=lower(paterno) AND lower('$apepromm')=lower(materno)";

$rest="),'$nombre','$paterno','$materno','$domicilio',upper('$colonia'),upper('$municipio'),'$seccion','$telefono','$ocr',$idr,'$fechared');";

$sql .= $select.$rest;




if ($con->query($sql) === TRUE) {
    $result=mysqli_query($con,"Select id_lider from promotores where lower('$nomprom')=lower(Nombre) AND lower('$apepromp')=lower(paterno) AND lower('$apepromm')=lower(materno)");
    
    $idb=mysqli_fetch_array($result);
    $id=$idb["id_lider"];
        
    $fullname=mysqli_query($con,"Select lideres.Nombre,lideres.paterno,lideres.materno from lideres, promotores where lideres.id='".$id."'");
    
    $data=mysqli_fetch_array($fullname);
        
    $name=$data["Nombre"];
    $paterno=$data["paterno"];
    $materno=$data["materno"];
    
    $array=["name" =>$name,"paterno" => $paterno, "materno" => $materno];
    
    echo json_encode($array);
    
    
} else {
    if($con->error==="Column 'id_promotor' cannot be null"){
        echo "Verifique que los datos del promotor esten correctos";   
    }else{
        echo "Error updating record: " . $con->error;
    }
}
    
?>