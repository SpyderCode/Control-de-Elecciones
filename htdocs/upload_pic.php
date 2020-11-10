<?php
//Esta algo feo mi codigo pero shhh nadie se da cuenta
require "Connect.php";
define('KB', 1024);
define('MB', 1048576);
$return="Configuración.html";

$new_file = __DIR__ . '/' . "logo.png";

if ( is_writable(dirname($new_file)) ) {//checar que tenga permiso para escribir a la carpeta
    $name = $_FILES['fileToUpload']['name'];
    $ext = (explode(".", $name));
    $ext=end($ext);
    $file_size = $_FILES['fileToUpload']['size'];
    
    if($file_size < 15*MB){
    
    if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){//ch
        if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
            
            echo '<script language="javascript">';
            echo 'alert("No es una imagen")';
            echo '</script>';
            readfile($return);
        }else{    
            rename("logo.png","logo_backup.png");
            move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $new_file );
            readfile($return);
     }
        
        
    }else{
        echo '<script language="javascript">';
        echo 'alert("Seleccione una imagen")';
        echo '</script>';
      readfile($return);  
    }
    }else{
      echo '<script language="javascript">';
        echo 'alert("Archivo es muy grande")';
        echo '</script>';
      readfile($return);    
    }
    
    
} else {
    echo '<script language="javascript">';
        echo 'No tiene permiso para escribir a la carpeta de xampp (corre xampp como admin)';
        echo '</script>';
      readfile($return); 
}
?>