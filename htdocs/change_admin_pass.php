<?php 
require "Connect.php";
if(!isset($_POST["NewPass"])){
    exit("Error al ingresar contraseña, ingrese la contraseña");
}
$OldPass=$_POST["OldPass"];
$Pass=password_hash($_POST["NewPass"],PASSWORD_DEFAULT);
$id=$_SESSION["id"];
$name=$_SESSION["name"];

if ($stmt = $con->prepare('SELECT password FROM accounts WHERE id = ?')) {
    $stmt->bind_param('s', $id);
    $stmt->execute();
    
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
    $stmt->bind_result($password);   
    $stmt->fetch();
        if (password_verify($_POST['OldPass'], $password)) {
           // Verification success! User has loggedin!
            $sql="UPDATE accounts SET password='$Pass' WHERE id='$id'";
            if ($con->query($sql) === TRUE) {
            echo "Listo! Los datos fueron modificados del usuario con este email:".$name;
                }else {
                echo "Error updating record: " . $con->error;
                }
            }else {
		echo 'Incorrect password!';
        }   
    }
    $stmt->close();
}
?>