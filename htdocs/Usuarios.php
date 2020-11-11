<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>UsuariosAdmin</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/1078351fe9.js" crossorigin="anonymous"></script>
<link href="tipos.css" rel="stylesheet" type="text/css">
<link href="cssejemplo.css" rel="stylesheet" type="text/css">
</head>   
<body onload="checksession()">
    
<?php 
    require "Connect.php";
    //require "verify_admin.php";
    
    
//Para el search
    if (isset($_POST['valor'])){
        $valor=$_POST['valor'];
        $result = mysqli_query($con,"SELECT * FROM accounts WHERE (username LIKE '%".$valor."%') OR (id LIKE '%".$valor."%')");
    }else{
     $result = mysqli_query($con,"SELECT * FROM accounts");   
    }
    
    $con->close();
    ?>
	
<div class="container">
	<div class="primary_header">
	    <h1 class="title"> USUARIOS REGISTRADOS</h1> 
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
    <form action="Usuarios.php" method="post">
	<div class="Buscar">
		<i class="fas fa-search"></i>
		 <input type="text" placeholder="Buscador" name="valor">
	</div>
    </form>
	<div class="Tabla">
<table class="table">
  <tbody>
      
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
      <th>Tipo De Usuario</th>
    </tr>
    <!--Para que aparezca el los datos al table    -->
      <?php 
      
      while($row = mysqli_fetch_array($result)){
            $id=$row["id"];
          $table_header= "<td>" .
              '<select status_id="'.$id.'" id="menu" class="menu" onchange="test('.$id.',this)">';
          
          echo "<tr onclick='javascript:showRow(this);javascript:highlight($id)' class='table_row' id='$id'>";
          
          echo "<td id='testing'>" . $row["id"] . "</td>";
          echo "<td>" . $row["username"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "<td>" . $row["Telefono"] . "</td>";
          echo "<td>" . $row["calle"] . "</td>";
          echo "<td>" . $row["numExt"] . "</td>";
          echo "<td>" . $row["numInt"] . "</td>";
          echo "<td>" . $row["colonia"] . "</td>";
          echo "<td>" . $row["municipio"] . "</td>";
          
          if ($row["Role"]=="Admin"){
            echo $table_header; 
            echo "<option value='Nada'>Deshabilitado</option>";
            echo "<option value='Coordinador'>Coordinador</option>";
            echo "<option value='Capturista'>Capturista</option>";
            echo "<option value='Admin' selected>Admin</option>"; 
           
          }elseif($row["Role"]=="Coordinador"){
            echo $table_header; 
            echo "<option value='Nada'>Deshabilitado</option>";
            echo "<option value='Coordinador' selected>Coordinador</option>";
            echo "<option value='Capturista'>Capturista</option>";
            echo "<option value='Admin'>Admin</option>";
            
            echo " </select>";
              echo "</td>";
          }elseif($row["Role"]=="Capturista"){
            echo $table_header; 
            echo "<option value='Nada'>Deshabilitado</option>";
            echo "<option value='Coordinador'>Coordinador</option>";
            echo "<option value='Capturista' selected>Capturista</option>";
            echo "<option value='Admin'>Admin</option>";
          }else{
            echo $table_header; 
            echo "<option value='Nada' selected>Deshabilitado</option>";
            echo "<option value='Coordinador'>Coordinador</option>";
            echo "<option value='Capturista'>Capturista</option>";
            echo "<option value='Admin'>Admin</option>";
          }
          echo "</tr>";
    }
      ?>
	</tbody>
       
		</table>
	</div>
    
  <div class="Botones">
	  <button class="BoEliminar" onclick="document.getElementById('id01').style.display='block'">Eliminar</button>
	   <button class="BoModificar" onclick="document.getElementById('id02').style.display='block'">Modificar</button>
	   <button class="BoGuardar" id="save">Guardar</button>
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
     var role = selectObject.value;
     var personid=id;
     $.ajax({
        type: "POST",
        url: 'change_role.php',
        data: { personid: personid,role:role }, 
        success: function(data) {
        alert(data);
  }
});
    //alert(role);
    }
    
    </script>
<script>
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
    
    function deletion(){
        if(x){
        var result=confirm('¿Estas seguro?');
        if(result){
            var id=x[0].innerHTML;
            var name=x[1].innerHTML;    
            $.ajax({
            type: "POST",
            url: 'delete_user.php',
            data: { id:id,name:name }, 
            success: function(data) {
            alert(data);
                }   
            });
        
            x[0].closest("tr").remove();    
            x=null;
        }//end of if(result)
        
        } else{
            alert("seleccione un usuario");
            location.reload();
            
        }
    }
    /*  
            x[0] id
            x[1] name
            x[2] email
            x[3] tel
            x[4] street
            x[5] numEx
            x[6] numIn
            x[7] Colony
            x[8] Municipal
            
            $.ajax({
        type: "POST",
        url: 'delete_user.php',
        data: { id:id,name:name }, 
        success: function(data) {
        alert(data);
            }   
        });
            */
    function modify(){
        if(x){
            for(var i=1;i<9;i++){
                x[i].contentEditable="true";
            }
            
            
            document.getElementById("save").onclick=function(){
            var id=x[0].innerHTML;
            var name =x[1].innerHTML;
            var email=x[2].innerHTML;
            var tel=x[3].innerHTML;
            var street=x[4].innerHTML;
            var numEx=x[5].innerHTML;
            var numIn=x[6].innerHTML;
            var Colony=x[7].innerHTML;
            var Municipal=x[8].innerHTML;
                $.ajax({
                    type: "POST",
                    url: 'update_users.php',
                    data: { id:id,name:name,email:email,tel:tel,street:street,numEx:numEx,numIn:numIn,Colony:Colony,Municipal:Municipal }, 
                    success: function(data) {
                    alert(data);
                    }   
                });    
                
            for(var i=1;i<9;i++){
                x[i].contentEditable="false";
            }
                x=null;
                document.getElementById(prev_row).style.backgroundColor = 'white';
            };
            
        }else{
            alert("Seleccione un renglon");
            location.reload();
        }
    } //end modify
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
