<?php

require './database_connection.php';


if(!$_POST['usr'])
	die(header("location:register.php?userEmpty=1"));
if(!$_POST['email'])
	die(header("location:register.php?emailEmpty=1"));
if(!$_POST['firstname'])
	die(header("location:register.php?firstnameEmpty=1"));
if(!$_POST['lastname'])
	die(header("location:register.php?lastnameEmpty=1"));
if(!$_POST['pwd'])
	die(header("location:register.php?passEmpty=1"));
if(!$_POST['repeatpwd'])
	die(header("location:register.php?repeatPassEmpty=1"));
if($_POST['repeatpwd'] != $_POST['pwd'])
	die(header("location:register.php?notMatching=1"));

echo $_POST['repeatpwd'] . " " . $_POST['pwd'];

$username = $_POST['usr'];
$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];

if(!validateEmail($email)){
	die(header("location:register.php?invalidEmail=1"))
}
mysqli_close($connect);
?>
