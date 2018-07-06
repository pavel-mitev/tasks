<?php

$connect = mysqli_connect("localhost","root","","e_store");

if(!$connect){
  echo "Connection to DB not successfull Error:" . $connect->connect_errno;
  exit(1);
}
 ?>
