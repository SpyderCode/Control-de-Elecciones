<?php
require "Connect.php";
if ( !isset($_POST['email'], $_POST['password']) ) {
	// Si no agarra los datos manda un error
	exit('Porfavor ingrese los datos');
}

if ($stmt = $con->prepare('SELECT id, password, Role FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password, $Role);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
        session_start();
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['email'];
		$_SESSION['id'] = $id;
        $_SESSION['Role']=$Role;
        //Admin
        if ($_SESSION['Role']=='Admin'){
		header('Location: PaginaAdmin.html');
        } elseif($_SESSION['Role']=='Capturista'){
        header('Location: Capturista.html');    
        }elseif($_SESSION['Role']=='Coordinador'){
        header('Location: Coordinador.html');
        }else {
            header('Location: NuevoUsuario.php');
        }
	} else {
		echo "<script>alert('Incorrect password!')</script>";
        sleep(4);
        header('Location: index.html');
	}
} else {
	echo '<script type="text/javascript">alert("Email no existe!");</script>';
    
}

	$stmt->close();
}


?>