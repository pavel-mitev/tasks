<?php
if(!$_POST['usr'] && !$_POST['pwd']){
  die(header("location:login.php?formEmpty=true"));
}else if(!$_POST['usr']){
  die(header("location:login.php?userEmpty=true"));
}else if(!$_POST['pwd']){
  die(header("location:login.php?passwordEmpty=true"));
}

require "database_connection.php";

$user = mysqli_real_escape_string($connect,$_POST['usr']);
$password = mysqli_real_escape_string($connect,$_POST['pwd']);

$querystmt = "SELECT Password FROM Customers WHERE CustomerID = '$user'";

$result = mysqli_query($connect,$querystmt);

if(!$result->num_rows){
  die(header("location:login.php?failedLogin=true"));
}

$row = mysqli_fetch_assoc($result);

  if(password_verify($password,$row['Password'])){
    session_start();
    $_SESSION['username'] = $user;
    die(header("location:index.php"));
  }else
    die(header("location:login.php?failedLogin=true"));


mysqli_close($connect);
 ?>
