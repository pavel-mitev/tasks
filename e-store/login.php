<?php
session_start();
if($_SESSION['username']){
  die(header("location:index.php"));
}
 ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="./index.html">E-Store</a>
      </div>
      <ul class="nav navbar-nav" style="float:right;">
        <li><a href="./index.html">Home</a></li>
        <li class="active"><a href="./login.php">Login</a></li>
        <li><a href="./register.php">Register</a></li>
        <li><a href="#">Products</a></li>
      </ul>
    </div>
  </nav>

  <?php
    if($_GET["formEmpty"] || $_GET["userEmpty"] || $_GET["passwordEmpty"] || $_GET["failedLogin"])
    {
      echo "<div class='container'>";
      echo "<div class='alert alert-danger'>";
      if($_GET["formEmpty"])
        echo "<strong>Enter username and password</strong>";
      if($_GET["userEmpty"])
        echo "<strong>Enter username</strong>";
      if($_GET["passwordEmpty"])
        echo "<strong>Enter password</strong>";
      if($_GET["failedLogin"])
        echo "<strong>Invalid username or password</strong>";
      echo "</div>";
      echo "</div>";
    }
  ?>
  <div class="container">
    <form action="./login_authentication.php" method="post">
      <div class="form-group col-xs-6">
        <label for="usr">Username:</label>
        <input type="text" name="usr" class="form-control" id="usr">
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" class="form-control" id="pwd">
        <input type="submit" class="btn btn-default" value="Login">
      </div>
    </form>
  </div>
</body>
</html>
