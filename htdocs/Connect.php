<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database ="phplogin";

//Crea una conexion a la base de datos
$con = mysqli_connect($server,$username,$password) or die("Error conectando al servidor");
mysqli_select_db($con,$database ) or die("No se pudo conectar a la base de datos");


?>