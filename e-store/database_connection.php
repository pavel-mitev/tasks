<?php

$connect = mysqli_connect("localhost","root","ivanov1997","e_store");

if(!$connect){
  echo "Connection to DB not successfull Error:" . $connect->connect_errno;
  exit(1);
}
 ?>
