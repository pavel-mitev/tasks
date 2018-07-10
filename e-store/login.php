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

    <div class="container">
      <legend style="font-size:30px;">Login</legend>
    </div>

    <?php
      if($_GET["failedLogin"]){
        echo "<div class='container'><div class='alert alert-danger'><strong>Invalid Login</strong></div></div>";
      }
    ?>
    <form id="loginForm" action="./login_authentication.php" method="post">
      <div class="container">
        <div class="container">
          <div id="userField" class="form-group col-xs-6">
            <label for="usr">Username</label>
            <input type="text" name="usr" class="form-control" id="usr" onblur="checkUsername();">
          </div>
        </div>
        <div class="container">
          <div id="passwordField" class="form-group col-xs-6">
            <label for="pwd">Password</label>
            <input type="password" name="pwd" class="form-control" id="pwd" onblur="checkPassword();">
          </div>
        </div>
        <div class="container">
         <div class="form-group col-xs-6">
            <input type="button" class="btn btn-default" value="Login" onclick="validateForm();">
          </div>
        </div>
      </div>
    </form>

    <script>
        var usernameInput = document.getElementById("usr");
        var usernameField = document.getElementById("userField");

        var passwdInput = document.getElementById("pwd");
        var passwdField = document.getElementById("passwordField");

      function validateForm(){
        var validForm = true;

        if(passwdInput.value == ""){
          if(passwdField.childElementCount == 2)
            appendErrMsg("Enter password",passwdField);
            passwdInput.style.borderColor = "red";
          validForm = false;
        }
        if(usernameInput.value == ""){
          if(usernameField.childElementCount == 2)
            appendErrMsg("Enter username",usernameField);
            usernameInput.style.borderColor = "red";
          validForm = false;
        }

        if(validForm){
          document.getElementById("loginForm").submit();
          return true;
        }else{
          return false;
        }


      }

      function checkPassword(){
        if(passwdInput.value != "" && passwdField.childElementCount > 2){
          passwdField.removeChild(passwdField.children[2]);
          passwdInput.style.borderColor = "";
        }
      }

      function checkUsername(){
        if(usernameInput.value != "" && usernameField.childElementCount > 2){
          usernameField.removeChild(usernameField.children[2]);
          usernameInput.style.borderColor = "";
        }
      }


      function appendErrMsg(errorMsg,elem){
        var p = document.createElement("P");
        p.style.color = "red";
        var t = document.createTextNode(errorMsg);
        p.appendChild(t);
        elem.appendChild(p);
      }
    </script>
</body>
</html>
