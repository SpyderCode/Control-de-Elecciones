<?php

require "Connect.php";
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {

    exit('Porfavor complete el registro');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Porfavor complete el registro');
}

if ($stmt = $con->prepare('SELECT email, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'El email ya esta registrado';
	} else {
		// Username doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO accounts (email, password,username,Telefono,calle,numExt,numInt,colonia,municipio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sssssssss', $_POST['email'], $password, $_POST['username'],$_POST['telefono'],$_POST['Calle'],$_POST['Exterior'],$_POST['Interior'],$_POST['colonia'],$_POST['municipio']);
	$stmt->execute();
	echo "<script>
    alert('Registrado!');
    window.location.href='http://localhost/Login/index.html';
    </script>"; 
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>