<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Lideres</title>
<script src="https://kit.fontawesome.com/1078351fe9.js" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="tipos.css" rel="stylesheet" type="text/css">
<link href="cssejemplo.css" rel="stylesheet" type="text/css">
</head>

<body onload="checksession()">
<?php
    require "Connect.php";
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true){
    }else{
        readfile("index.html");
    }
    
    //Para el search
    if (isset($_GET['valor'])){
        $valor=$_GET['valor'];
        $result=mysqli_query($con,"select lideres.id,lideres.Nombre,lideres.paterno,lideres.materno,lideres.domicilio,lideres.colonia,lideres.municipio,lideres.seccion,lideres.ocr,lideres.telefono,(SELECT COUNT(* ) from promotores WHERE promotores.id_lider=lideres.id) as promotores,(SELECT COUNT(*) from promovidos,promotores WHERE (promotores.id_lider=lideres.id) AND (promotores.id=promovidos.id_promotor)) as promovidos FROM lideres WHERE (id LIKE '%".$valor."%') OR (Nombre LIKE '%".$valor."%')");
    }else{
      $result=mysqli_query($con,"select lideres.id,lideres.Nombre,lideres.paterno,lideres.materno,lideres.domicilio,lideres.colonia,lideres.municipio,lideres.seccion,lideres.ocr,lideres.telefono,(SELECT COUNT(*) from promotores WHERE promotores.id_lider=lideres.id) as promotores,(SELECT COUNT(*) from promovidos,promotores WHERE (promotores.id_lider=lideres.id) AND (promotores.id=promovidos.id_promotor)) as promovidos FROM lideres");   
    }
    $con->close();   
    
    ?>   
    
    
	<div class="container">
		<div class="primary_header">
	    <h1 class="title"> LÍDERES</h1>
		</div>
		
 <div class="navbar">
   <div class ="dropdown">
    <button class="dropbtn">
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="Configuración.html">Configuración</a>
	  <a href="destroy_session.php">Cerrar Sesión</a>
    </div>
   </div>
	  <a href="PaginaAdmin.html">Inicio</a>
</div>
		&nbsp;
        <form action="Lideres.php" method="get">
		<div class="contenedor-inp">
			<i class="fas fa-search"></i>
			<input type="text" placeholder="Buscar" name="valor">
		</div>
        </form>
 <div class="Tabla">
	 <p class="titulo">Datos</p>
   <table class="table">
     <tr>
        <th>ID</th>
        <th>Nombre</th>
		 <th>Apellido Paterno</th>
		 <th>Apellido Materno</th>
        <th>Domicilio</th>
		 <th>Colonia/Comunidad</th>
		 <th>Municipio</th>
        <th>Sección</th>
        <th>OCR</th>
        <th>Teléfono</th>
        <th>Promotores</th>
		<th>no. de Redes</th>
    </tr>
     <!--Para que aparezca el los datos al table    -->
      <?php
       while($row = mysqli_fetch_array($result)){
            $id=$row["id"]; 
            echo "<tr onclick='javascript:showRow(this);javascript:highlight($id)' class='table_row' id='$id'>";
           
           echo "<td id='testing'>" . $row["id"] . "</td>"; 
           echo "<td>" . $row["Nombre"] . "</td>";
           echo "<td>" . $row["paterno"] . "</td>";
           echo "<td>" . $row["materno"] . "</td>";
           echo "<td>" . $row["domicilio"] . "</td>";
           echo "<td>" . $row["colonia"] . "</td>";
           echo "<td>" . $row["municipio"] . "</td>";
           echo "<td>" . $row["seccion"] . "</td>";
           echo "<td>" . $row["ocr"] . "</td>";
           echo "<td>" . $row["telefono"] . "</td>";
           
           echo "<td>" . $row["promotores"] . "</td>"; 
           echo "<td>" . $row["promovidos"] . "</td>"; 
           
           echo "</tr>";
       }
       ?>
   </table>
</div>
		<div class="Bottones">
		 <button class="booton" onclick="document.getElementById('id01').style.display='block'">Eliminar</button> 
		 <button class="booton" onclick="document.getElementById('id02').style.display='block'">Modificar</button>       
	     <button class="booton" id="save">Guardar</button>
		<a class="BotonGraf" href="GraficaLideres.php">Gráfica</a>
		</div>
	<div id="id01" class="modal">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<div class="modal-content animate">
			<div class="container">
				<label for="psw"><b>Contraseña</b></label>
				<input type="password" placeholder="Contraseña" name="psw" id="pswd" required>
				<button type="submit" onclick="verify_pass()">Guardar</button>
			</div>
		</div>
	</div>
	<div id="id02" class="modal">
			<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
			<div class="modal-content animate">
				<div class="container">
					<label for="psw"><b>Contraseña</b></label>
					<input type="password" placeholder="Contraseña" name="psw" id="pswd1" required>
					<button type="submit" onclick="verify_passsave()">Guardar</button>
				</div>
			</div>
		</div>
</div>
<script>
var modal = document.getElementById('id01');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
var modal = document.getElementById('id02');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
   function checksession(){
       $.ajax({
           type:"POST",
           url:"check_session.php",
           success:function(data){
             if(data==="redirect"){
               window.location.href = 'index.html'
             } 
           }      
       }); 
    }    
    //HIGHLIGHT
    var prev_row;
    function highlight(rowid){
        if(prev_row){
        document.getElementById(prev_row).style.backgroundColor = 'white';
        }
        prev_row=rowid;
        
        document.getElementById(rowid).style.backgroundColor = 'lightblue';
    }
    var x;
    function showRow(row){
      x=row.cells;
      
      
    }
    //DELETE
    function deletion(){
      if(x){
        var result=confirm('¿Estas seguro?');
        if(result){
            var id=x[0].innerHTML;
            var name=x[1].innerHTML;
          
            $.ajax({
            type: "POST",
            url: 'delete_lideres.php',
            data: { id:id,name:name }, 
            success: function(data) {
            alert(data);
            }   
        });
          
        x[0].closest("tr").remove();    
        x=null;
      }else{location.reload();}//end of if(result)
          
      }else{
       alert("seleccione un usuario"); 
    location.reload();
      }  
    }
    //MODIFY
    function modify(){
        if(x){
                for(var i=1;i<10;i++){
                x[i].contentEditable="true";
            }
            
            
            document.getElementById("save").onclick=function(){
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
            
            $.ajax({
            type: "POST",
            url: 'update_lideres.php',
            data: { id:id,name:name,paterno:paterno,materno:materno,domicilio:domicilio,colonia:colonia,municipio:municipio,seccion:seccion,ocr:ocr,telefono:telefono }, 
            success: function(data) {
            alert(data);
                }   
            });
                for(var i=1;i<10;i++){
                x[i].contentEditable="false";
                }

            
            x=null;
            document.getElementById(prev_row).style.backgroundColor = 'white';
            };
            
        }else{
            alert("Primero seleccione un renglon");
            location.reload();
        }
    } //end modify
    function verify_pass(){
        var pswd=document.getElementById("pswd").value;
        $.ajax({
           type:"POST",
           url:"verify_password.php",
            data: {pswd:pswd},
           success:function(data){
             if(data==="true"){
                deletion();
                 modal.style.display = "none";
                 document.getElementById("pswd").value="";
             }else{
                     alert("Contraseña esta Incorrecta");
                 location.reload();
                 }
             } 
           
           
       });
    }
    function verify_passsave(){
        var pswd=document.getElementById("pswd1").value;
            $.ajax({
           type:"POST",
           url:"verify_password.php",
            data: {pswd:pswd},
           success:function(data){
             if(data==="true"){
                modify();
                 modal.style.display = "none";
                 document.getElementById("pswd1").value="";
             }else{
                     alert("Contraseña esta Incorrecta");
                 location.reload();
                 }
             } 
           
           
       });
    }
    
    
    </script>
</body>
</html>
