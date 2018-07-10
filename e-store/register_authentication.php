<?php

require './database_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!$_POST['usr'] || !$_POST['email'] || !$_POST['firstname'] || !$_POST['lastname'] || !$_POST['pwd'] || !$_POST['repeatpwd'])
	die(header("location:register.php?invalidForm=1"));

if(strcmp($_POST['repeatpwd'],$_POST['pwd']) || strlen($_POST['pwd'] < 6)){
	die(header("location:register.php?invalidPasswords=1"));
}

$username = mysqli_real_escape_string($connect,$_POST['usr']);
$email = mysqli_real_escape_string($connect,$_POST['email']);
$firstname = mysqli_real_escape_string($connect,$_POST['firstname']);
$lastname = mysqli_real_escape_string($connect,$_POST['lastname']);
$password = mysqli_real_escape_string($connect,$_POST['pwd']);

$queryUsername = "SELECT * FROM Customers WHERE CustomerID = '$username'";

$result = mysqli_query($connect,$queryUsername);

if($result->num_rows){
	die(header("location:register.php?userTaken=1"));
}

$queryEmail = "SELECT * FROM Customers WHERE Email = '$email'";
$result = mysqli_query($connect,$queryEmail);

if($result->num_rows){
	die(header("location:register.php?emailTaken=1"));
}
$password = password_hash($password,CRYPT_BLOWFISH);
$queryRegistration = "INSERT INTO Customers(CustomerID,Email,FirstName,LastName,Password) VALUES('$username','$email','$firstname','$lastname','$password')";

if(mysqli_query($connect,$queryRegistration)){
	die(header("location:register.php?regSuccess=1"));
}else{
	die(header("location:register.php?regFailed=1"));
}


mysqli_close($connect);
?>
