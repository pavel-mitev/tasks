<?php
session_start();

$_SESSION = array();
session_destroy();

die(header("location:login.php"));
 ?>
