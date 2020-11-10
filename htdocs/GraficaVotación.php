<!doctype html>
<?php
require "Connect.php";
$result=mysqli_query($con,"Select count(*) from promovidos where votado='Si'");
$data=mysqli_fetch_array($result);
$total=$data[0];
//Para la grafica
$query="select votado,count(*) from promovidos group by votado";
$exec=mysqli_query($con,$query);            
            
            ?>
<html lang="es">
<head>
<meta charset="utf-8">
<title>GráficaVotación</title>
<script src="https://kit.fontawesome.com/1078351fe9.js" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="tipos.css" rel="stylesheet" type="text/css">
<link href="cssejemplo.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<body onload="checksession()">
	<div class="conteiner">
	<div class="primary_header">
	    <h1 class="title">Total</h1>
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
	<div class="Grafica">
		<label class="contador"><?php
            echo $total;
            
            
            ?></label>
	</div>
		&nbsp;
	<div class="BDescargar">
		<button class="BotDecar" onclick="document.getElementById('id01').style.display='block'">Descargar</button>
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
<div id="printableArea">
    <div img src="logo.png" id="barchart_material" style="width: 900px; height: 500px;"></div>
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
           url:"check_session.php",
           success:function(data){
             if(data==="redirect"){
               window.location.href = 'index.html'
             } 
           }      
       });
    loadgoogle();
    } 
    
function loadgoogle(){
 google.charts.load('visualization', '1', {packages: ['bar']});       
 google.charts.setOnLoadCallback(drawChart);       
        
  function drawChart() {
   var data = google.visualization.arrayToDataTable([
   ["Votacion","Cantidad"],
       <?php 
       while($row=mysqli_fetch_array($exec)){
           echo "['".$row[0]."',".$row[1]."],";
           
       }
       ?>
   ]);   
 var options = {
          chart: {
            title: 'Top De Votaciones',
            subtitle: 'Las secciones que más han votado',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

    var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));    
      
  };        
    }
function download(){
    html2canvas(document.getElementById("barchart_material")).then(function (canvas){
        var image64=canvas.toDataURL("image/jpeg",1);
    console.log(canvas.toDataURL("image/jpeg",0.9)); 
    saveimage(image64,"GraficaVotado");    
    });
    
    }
function saveimage(base64,fileName){
    var link = document.createElement("a");
    document.body.appendChild(link); // for Firefox

    link.setAttribute("href", base64);
    link.setAttribute("download", fileName);
    link.click();
    
}
    function verify_pass(){
        var pswd=document.getElementById("pswd").value;
            $.ajax({
           type:"POST",
           url:"verify_password.php",
            data: {pswd:pswd},
           success:function(data){
             if(data==="true"){
                download();
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
