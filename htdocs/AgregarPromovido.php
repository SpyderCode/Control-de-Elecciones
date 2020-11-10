<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>NuevaRed</title>
<link href="Estilosn.css" rel="stylesheet" type="text/css">
<link href="cssejemplo.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="https://kit.fontawesome.com/1078351fe9.js" crossorigin="anonymous"></script>
</head>
<?php require "Connect.php"; ?>

<body onload="checksession()">	
	<div class="container">
	<div class="primary_header">
	<h1 class="title">AGREGAR UNA RED</h1>
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
	<a href="Capturista.html">Inicio</a>
	</div>
		<h1 class="DatosRed">Datos De Red</h1>
		<form class="DatRed">
			
		 <div class="ID">
			 <div class="id">
				 <label>ID de Red:</label>
			 </div>
			 <div class="idR">
				 <input id="idR" type="text" placeholder="ID de Red">
			 </div>
			  <div class="FechadeRed">
				 <label>Fecha de Red:</label>
			 </div>
			 <div class="FechadeRedR">
				 <input id="fecha" type="text" placeholder="aaaa-mm-dd">
			 </div>
		  </div>
			
		 <div class="NomLider">
			 <div class="NombreL">
				 <label>Nombre De Líder:</label>
			 </div>
			 <div class="NomLidR">
				 <label id="nomlid" class="NombreLP"></label>
			 </div>
			 <div class="ApeLidR">
				 <label id="apelidp" class="ApellidoP"></label>
			 </div>
			 <div class="ApeLidR">
				 <label id="apelidm" class="ApellidoM"></label>
			 </div>
		  </div>	
			
		  <div class="NomPromtr">
			 <div class="NombreP">
				 <label>Nombre De Promotor:</label>
			 </div>
			 <div class="NomPromR">
				 <input name="nomprom" id="nomprom" type="text" placeholder="Nombre Promotor">
			 </div>
			 <div class="ApePromR">
				 <input name="apepromp" id="apepromp" type="text" placeholder="Apellido Paterno">
			 </div>
			 <div class="ApePromR">
				 <input name="apepromm" id="apepromm" type="text" placeholder="Apellido Maternos">
			 </div>
		  </div>
		</form>
		
		<div class="Tabla">
			<p class="titulo">Datos De Promovidos</p>
			<table class="table" id="Tabla" >
				<tr>
				<th >Nombre</th>
				<th >Apellido Paterno</th>
				<th >Apellido Materno</th>
				<th >Domicilio</th>
				<th >Colonia/Comunidad</th>
				<th >Municipio</th>
				<th >Sección</th>
				<th >Teléfono</th>
				<th >OCR</th>
				</tr>
                
			</table>
	   </div>
		
		<div class="Botones">
			<button class="Boton" onclick="newRow()" id="nuevo">Nuevo</button>
			<button id="savebtn" class="Boton" onclick="document.getElementById('id01').style.display='block'" name="valor">Guardar</button>
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
    function checksession(){
       $.ajax({
           type:"POST",
           url:"check_session_capturista.php",
           success:function(data){
             if(data==="redirect"){
               window.location.href = 'index.html'
             } 
           }
           
           
       }); 
    }//Fin CHeck Session
    
    var rownum=1;
    var row;
    var newbutton=document.getElementById("nuevo");
    var savebutton=document.getElementById("savebtn");
    savebutton.disabled=true;
    var x;
    function newRow(){
        var table=document.getElementById("Tabla");
        row=table.insertRow(rownum);
        for(var i=0;i<9;i++){
         var cell = row.insertCell(i);
          cell.innerHTML = "A";
            cell.contentEditable="true";
            cell.innerHTML=null;
        }
        rownum=rownum+1;
        
        //Sets nuevo button as disabled
        newbutton.disabled=true;
        savebutton.disabled=false;
    }//end of newRow()
    
     
    var fullname={}; 
    function save(){ 
    x=row.cells;
    //REGEX
    var regEx = /^\d{4}-\d{2}-\d{2}$/;//Para el date yyyy-mm-dd
    //DATA
    var idr=document.getElementById("idR").value;
    var fechared=document.getElementById("fecha").value;
        
    var nomprom=document.getElementById("nomprom").value;
    var apepromp=document.getElementById("apepromp").value;
    var apepromm=document.getElementById("apepromm").value;
    //ROW DATA
    /*
    x[0]=Nombre
    x[1]=Apellido Paterno
    x[2]=Apellido Materno
    x[3]=Domicilio
    x[4]=Colonia
    x[5]=Municipio
    x[6]=Seccion
    x[7]=Telefono
    x[8]=OCR
    */    
    var nombre=x[0].innerHTML;
    var paterno=x[1].innerHTML;
    var materno=x[2].innerHTML;
    var domicilio=x[3].innerHTML;
    var colonia=x[4].innerHTML;
    var municipio=x[5].innerHTML;
    var seccion=x[6].innerHTML;
    var telefono=x[7].innerHTML;
    var ocr=x[8].innerHTML;
        
    //DO STUFF
 
    //Checa si hay campos vacios
    if(idr && fechared && nomprom && apepromp && apepromm && nombre && paterno && materno && domicilio && colonia && municipio && seccion && telefono && ocr){
        //Checa si ID_RED es un numero
        if(isNaN(idr) || isNaN(telefono)){//Si no, sale un error
            alert("ERROR:Solo se puede tener numeros en la paerte de id_red y telefono");
       }else{
           if(!fechared.match(regEx)){
             alert("ERROR:inserte una fecha real: Año-Mes-Dia (aaaa-mm-dd)");  
           }else{
               if(telefono.length>=10){
                $.ajax({
            type: "POST",
            url: 'insert_promovido.php',
            data: {idr:idr,fechared:fechared, nomprom:nomprom, apepromp:apepromp, apepromm:apepromm, nombre:nombre, paterno:paterno, materno:materno, domicilio:domicilio,colonia:colonia, municipio:municipio,seccion:seccion, telefono:telefono,ocr:ocr}, 
            success: function(data) {
            try{
               data = JSON.parse(data);
                fullname=data;
                console.log(fullname);
                console.log(data);
                console.log(data.name);
                document.getElementById("nomlid").textContent=fullname.name;
                document.getElementById("apelidp").textContent=fullname.paterno;
                document.getElementById("apelidm").textContent=fullname.materno;
                alert("Datos ingresados a la base de datos");
            }catch(e){
                alert(data);}
            
                }   
            });
           /* var called=1;
            $.ajax({
            type: "POST",
            url: 'AgregarPromovido.php',
            data: {nomprom:nomprom, apepromp:apepromp, apepromm:apepromm, called:called}, 
            success: function(data) {
                }   
            });
            called=0;*/
            //sets nuevo button as enabled
            newbutton.disabled=false;
            savebutton.disabled=true;
            //alert(newbutton.disabled);
    
            for(var i=0;i<9;i++){
                x[i].contentEditable="false";
            }//End for  
           
       }else{
           alert("Numero telefonico debe ser de 10 numeros.");
       }
           }//END if fecha  
       }//end of if NAN
    }else{//Si si, sale un error
        alert("ERROR:Hay Campos sin datos");
    }
   
        
    }//End of Save()
   
    function verify_pass(){
        var pswd=document.getElementById("pswd").value;
            $.ajax({
           type:"POST",
           url:"verify_password.php",
            data: {pswd:pswd},
           success:function(data){
             if(data==="true"){
                save();
                 modal.style.display = "none";
                 document.getElementById("pswd").value="";
             }else{
                     alert("Contraseña esta Incorrecta");
                 }
             } 
           
           
       });
    }
</script>
</body>
</html>
