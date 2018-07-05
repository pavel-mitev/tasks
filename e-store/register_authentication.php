<?php

require './database_connection.php';

if(!isset($_POST['usr'])){
  var_dump($_POST['usr'])
}
echo $_POST['usr'] . "hello";

mysqli_close($connect);
?>
