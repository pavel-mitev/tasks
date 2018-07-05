<?php
if(!$_POST['usr'] || !$_POST['pwd']){
  echo "Enter username and password";
  die(header("location:login.php?LoginFailed=true"));
}
 ?>
