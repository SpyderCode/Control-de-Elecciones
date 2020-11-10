<?php 
require "Connect.php";

$id= $_POST["personid"];
$votado=$_POST["votado"];

$sql="UPDATE promovidos SET votado='$votado' WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    echo "Listo! ID:".$id." ahora ".$votado." tiene voto";
} else {
    echo "Error updating record: " . $con->error;
}

$con->close();


?>