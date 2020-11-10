<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Promovidos</title>
<script src="https://kit.fontawesome.com/1078351fe9.js" crossorigin="anonymous"></script>
<link href="nEstilo.css" rel="stylesheet" type="text/css">
<link href="cssejemplo.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body onload="checksession()">
<?php 
    require "Connect.php";
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true){
    }else{
        readfile("index.html");
    }
    
    //Para el search
    if (isset($_POST['valor'])){
        $valor=$_POST["valor"];
        $result=mysqli_query($con,"select promovidos.id, lideres.Nombre as Lider,promotores.Nombre as promotor,promovidos.nombre,promovidos.paterno,promovidos.materno,promovidos.domicilio,promovidos.colonia,promovidos.municipio,promovidos.seccion,promovidos.telefono,promovidos.clave_elector,promovidos.id_red,promovidos.fecha_red,promovidos.fecha_captura,promovidos.votado FROM promovidos,promotores,lideres WHERE (lideres.id=promotores.id_lider) AND (promotores.id=promovidos.id_promotor) AND ((promovidos.seccion LIKE '%".$valor."%')OR (promovidos.clave_elector LIKE '%".$valor."%') OR (promovidos.id LIKE '%".$valor."%'))");
    }else{
        $result=mysqli_query($con,"select promovidos.id, lideres.Nombre as Lider,promotores.Nombre as promotor,promovidos.nombre,promovidos.paterno,promovidos.materno,promovidos.domicilio,promovidos.colonia,promovidos.municipio,promovidos.seccion,promovidos.telefono,promovidos.clave_elector,promovidos.id_red,promovidos.fecha_red,promovidos.fecha_captura,promovidos.votado FROM promovidos,promotores,lideres WHERE (lideres.id=promotores.id_lider) AND (promotores.id=promovidos.id_promotor)");
    }
    
    $con->close();
    ?>
    
	<div class="container">
		<div class="primary_header">
	    <h1 class="title">PROMOVIDOS</h1>
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
    <form action="Promovidos.php" method="post">
	<div class="contenedor-inp">
			<i class="fas fa-search"></i>
			<input type="text" placeholder="Buscar" name="valor">
		</div>	
        </form>
		 <div class="Tabla">
	 <p class="titulo">Datos</p>
   <table class="table" >
     <tr>
        <th >ID</th>
        <th >Nombre De Líder</th>
        <th >Nombre De Promotor</th>
		 <th >Nombre</th>
		 <th >Apellido Paterno</th>
		 <th >Apellido Materno</th>
		<th >Domicilio</th>
		 <th >Colonia/Comunidad</th>
		 <th >Municipio</th>
		 <th >Sección</th>
		 <th >Teléfono</th>
		 <th >OCR</th>
		 <th >ID De Red</th>
		 <th >Fecha De Red</th>
		 <th >Fecha De Captura</th>
         <th >Votado</th>
    </tr>
      <!--Para que aparezca el los datos al table    -->
       <?php 
       while($row = mysqli_fetch_array($result)){
        
            $id=$row["id"];
           $table_header= "<td>" .
              '<select status_id="'.$id.'" id="menu" class="menu" onchange="test('.$id.',this)">';
           
            echo "<tr onclick='javascript:showRow(this);javascript:highlight($id)' class='table_row' id='$id'>";
           
              echo "<td>" . $row["id"] . "</td>";
            echo "<td id='testing'>" . $row["Lider"] . "</td>";
            echo "<td>" . $row["promotor"]."". "</td>";
           echo "<td>" . $row["nombre"]."" . "</td>";
           echo "<td>" . $row["paterno"]."" . "</td>";
           echo "<td>" . $row["materno"]."" . "</td>";
            echo "<td>" . $row["domicilio"] . "</td>";
           echo "<td>" . $row["colonia"]."" . "</td>";
           echo "<td>" . $row["municipio"]."" . "</td>";
           
            echo "<td>" . $row["seccion"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td>" . $row["clave_elector"] . "</td>";
            echo "<td>" . $row["id_red"] . "</td>";
            echo "<td>" . $row["fecha_red"] . "</td>";
            echo "<td>" . $row["fecha_captura"] . "</td>";
           if($row["votado"]==="No"){
               echo $table_header;
               echo "<option value='No' selected>No</option>";
               echo "<option value='Si'>Si</option>";
               }else{
               echo $table_header;
               echo "<option value='Si' selected>Si</option>";
               echo "<option value='No'>No</option>";
           }
           
           
           
            echo "</tr>";
       }
       ?> 
       
   </table>
</div>
		<div class="Bottones">
		 <button class="booton" onclick="document.getElementById('id01').style.display='block'">Eliminar</button> 
		 <button class="booton" onclick="document.getElementById('id02').style.display='block'">Modificar</button>  
	     <button class="booton" id="save">Guardar</button>
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
    function test(id,selectObject){
     var votado = selectObject.value;
     var personid=id;
     $.ajax({
        type: "POST",
        url: 'change_votado.php',
        data: { personid: personid,votado:votado }, 
        success: function(data) {
        alert(data);
  }
});
    //alert(role);
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
            var domicilio=x[3].innerHTML;
          
            $.ajax({
            type: "POST",
            url: 'delete_promovidos.php',
            data: { id:id,domicilio:domicilio }, 
            success: function(data) {
            alert(data);
            }   
        });
          
        x[0].closest("tr").remove();    
        x=null;
      }//end of if(result)
          
      }else{
       alert("seleccione un renglon");   
      }  
    }
    /*
       x[0]=id
       x[1]=lider
       x[2]=promotor
       x[3]=domicilio
       x[4]=seccion
       x[5]=telefono
       x[6]=clave_elector
       x[7]=id_red
       x[8]=fecha_red
       x[9]=fecha_captura
       */
    //MODIFY
        function modify(){
        if(x){
            for(var i=3;i<14;i++){
                x[i].contentEditable="true";
            }
            
            
            document.getElementById("save").onclick=function(){
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
                $.ajax({
                    type: "POST",
                    url: 'update_promovidos.php',
                    data: {id:id,nombre:nombre,paterno:paterno,materno:materno,domicilio:domicilio,colonia:colonia,municipio:municipio,seccion:seccion,telefono:telefono,clave_elector:clave_elector,id_red:id_red,fecha_red:fecha_red }, 
                    success: function(data) {
                    alert(data);
                    }   
                });    
                
            for(var i=3;i<14;i++){
                x[i].contentEditable="false";
            }
                x=null;
                document.getElementById(prev_row).style.backgroundColor = 'white';
            };
            
        }else{
            alert("Seleccione un renglon");
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
                 location.reload();
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
