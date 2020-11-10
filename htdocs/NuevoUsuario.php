<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Capturista</title>
<link href="Estilosn.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/1078351fe9.js" crossorigin="anonymous"></script>
</head>
<body onload="checksession()">

<?php 
    require "Connect.php";
    $id=$_SESSION['id'];
    $sql=mysqli_query($con,"select * from accounts where id='$id'");
    
    $con->close();
    ?>
    
    
<div class="container">	
	
	<div class="primary_header">
	<h1 class="title">NUEVO USUARIO</h1>
	</div>
  
	<div class="navbar">
	<div class ="dropdown">
		<button class="dropbtn">
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="destroy_session.php">Cerrar Sesión</a>
		</div>
	</div>
	<a href="NuevoUsuario.php">Inicio</a>
	</div>	
	
	<div class="logo"><img src="logo.png" width="512" height="100" alt=""/></div>
	
	<div class="Tabla">
	<table class="table">
   	 <tr>
      <th>ID</th>
      <th>Nombre Completo</th>
      <th>Correo Electrónico</th>
      <th>Teléfono</th>
      <th>Calle</th>
      <th>No. Exterior</th>
      <th>No. Interior</th>
      <th>Colonia</th>
      <th>Municipio</th>
      <!---<th>Tipo De Usuario</th>--->
   	 </tr>
    <?php 
     $row=mysqli_fetch_array($sql);
       echo "<td>" . $row["id"] . "</td>";
         echo "<td>" . $row["username"] . "</td>";
         echo "<td>" . $row["email"] . "</td>";
         echo "<td>" . $row["Telefono"] . "</td>";
         echo "<td>" . $row["calle"] . "</td>";
         echo "<td>" . $row["numExt"] . "</td>";
         echo "<td>" . $row["numInt"] . "</td>";
         echo "<td>" . $row["colonia"] . "</td>";
         echo "<td>" . $row["municipio"] . "</td>";
         //echo "<td>" . $row["Role"] . "</td>";
        
        
        
        ?> 
    
	</table>
	</div>
	
</div>	
<script>
    function checksession(){
       $.ajax({
           type:"POST",
           url:"check_session_newUser.php",
           success:function(data){
             if(data==="redirect"){
               window.location.href = 'index.html'
             } 
           }
           
           
       }); 
    }   
</script>
</body>
</html>
