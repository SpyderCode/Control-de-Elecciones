<?php
require "Connect.php"; 

$pass=$_POST["pswd"];
$id=$_SESSION["id"];
$name=$_SESSION["name"];
if ($stmt = $con->prepare('SELECT password FROM accounts WHERE id = ?')) {
    $stmt->bind_param('s', $id);
    $stmt->execute();
    
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
    $stmt->bind_result($password);   
    $stmt->fetch();
        if (password_verify($_POST["pswd"], $password)) {
             echo "true";   
            }else {
		echo 'false' .$pass.$id.$name;
        }   
    }
    $stmt->close();
}
?>