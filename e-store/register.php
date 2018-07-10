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
        <li><a href="./login.php">Login</a></li>
        <li class="active"><a href="./register.php">Register</a></li>
        <li><a href="#">Products</a></li>
      </ul>
    </div>
  </nav>
    <div class="container">
      <legend style="font-size:30px;">Registration</legend>
    </div>

    <?php
        if($_GET["invalidForm"])
          echo "<div class='alert alert-danger'> <strong>Filling all fields in the form is required.</strong> </div>";

        if($_GET["regSuccess"])
          echo "<div class='alert alert-success'><strong>Registration successful! You can log in now! </strong></div>";

    ?>
    <form action="./register_authentication.php" id="regForm" method="post">
    <div class="container">
      <div class="form-group">
        <div class="col-xs-6"  id="userField">
            <label for="usr">Username</label>
            <input type="text" class="form-control" id="usr" name="usr" maxlength="50" onblur="userCheck();">
        </div>
      </div>
    </div>

    <div class=container>
      <div class="form-group">
        <div class="col-xs-6" id="emailField">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" maxlength="50" onblur="emailCheck();">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="form-group">
        <div class="col-xs-3" id="firstnameField">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" maxlength="50" onblur="firstnameCheck();">
        </div>
        <div class="col-xs-3" id="lastnameField">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" maxlength="50" onblur="lastnameCheck();">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="form-group col-xs-6" id="pwdField">
        <label for="pwd">Password</label>
        <input type="password" class="form-control" id="pwd" name="pwd" maxlength="50" onblur="passwordCheck(); repeatpwdCheck();">
      </div>
    </div>

    <div class="container">
      <div class="form-group col-xs-6" id="repeatpwdField">
        <label for="repeatpwd">Re-enter Password</label>
        <input type="password" class="form-control" id="repeatpwd" name="repeatpwd" maxlength="50" onblur="repeatpwdCheck();">
      </div>
    </div>
    <div class="container">
      <div class="form-group col-xs-2">
        <input type="button" class="btn btn-default" value="Register" onclick="return validateForm();">
      </div>
    <div>
    </form>

    <script>

        var userField = document.getElementById("userField");
        var userInput = document.getElementById("usr");

        function userCheck(){
          if(userField.childElementCount == 2 && userInput.value == ""){
            userInput.style.borderColor = "red";
            appendErrMsg("Username is required", userField);
          }else if(userField.childElementCount > 2 && userInput.value != ""){
            userField.removeChild(userField.children[2]);
            userInput.style.borderColor = "";
          }
        }

        var emailField = document.getElementById("emailField");
        var emailInput = document.getElementById("email");
        
        function emailCheck(){
          var emailRegEx = /.+@.+\..+/i;

          if(emailField.childElementCount == 2 && !emailRegEx.test(emailInput.value)){
              emailInput.style.borderColor = "red";
              appendErrMsg("Valid email address is required",emailField);
          }else if(emailField.childElementCount > 2 && emailRegEx.test(emailInput.value)){
            emailField.removeChild(emailField.children[2]);
            emailInput.style.borderColor = "";
          }
        }

        var firstnameField = document.getElementById("firstnameField");
        var firstnameInput = document.getElementById("firstname");
        
        function firstnameCheck(){
          if(firstnameField.childElementCount == 2 && firstnameInput.value == ""){
            firstnameInput.style.borderColor = "red";
            appendErrMsg("First name is required",firstnameField);

          }else if(firstnameField.childElementCount > 2 && firstnameInput.value != ""){
            firstnameField.removeChild(firstnameField.children[2]);
            firstnameInput.style.borderColor = "";
          }
        }

        var lastnameField = document.getElementById("lastnameField");
        var lastnameInput = document.getElementById("lastname");

        function lastnameCheck(){
          if(lastnameField.childElementCount == 2 && lastnameInput.value == ""){
            lastnameInput.style.borderColor = "red";
            appendErrMsg("Last name is required",lastnameField);
          }else if(lastnameField.childElementCount > 2 && lastnameInput.value != ""){
            lastnameField.removeChild(lastnameField.children[2]);
            lastnameInput.style.borderColor = "";
          }
        }

        var passwordInput = document.getElementById("pwd");
        var passwordField = document.getElementById("pwdField");
        
        function passwordCheck(){
          passwordRegEx = /.{6,}/;
          if(passwordField.childElementCount == 2 && !passwordRegEx.test(passwordInput.value)){
            passwordInput.style.borderColor = "red";
            appendErrMsg("Password must be atleast 6 characters long",passwordField);
          }else if(passwordField.childElementCount > 2 && passwordRegEx.test(passwordInput.value)){    
            passwordField.removeChild(passwordField.children[2]);
            passwordInput.style.borderColor = "";
          }
        }

        var repeatpwdField = document.getElementById("repeatpwdField");
        var repeatpwdInput = document.getElementById("repeatpwd");

        function repeatpwdCheck(){
          if(repeatpwdField.childElementCount == 2 && (passwordInput.value != repeatpwdInput.value || repeatpwdInput.value == "")){
            repeatpwdInput.style.borderColor = "red";
            appendErrMsg("Passwords must be matching",repeatpwdField);
          }else if(repeatpwdField.childElementCount > 2 && (passwordInput.value == repeatpwdInput.value) && repeatpwdInput.value != ""){
            repeatpwdField.removeChild(repeatpwdField.children[2]);
            repeatpwdInput.style.borderColor = "";
          }
        }




      function appendErrMsg(errorMsg,elem){
        var p = document.createElement("P");
        p.style.color = "red";
        var t = document.createTextNode(errorMsg);
        p.appendChild(t);
        elem.appendChild(p);
      }

      function validateForm(){

        if(repeatpwdInput.value == "" || passwordInput.value == "" || lastnameInput.value == "" || firstnameInput.value == "" || emailInput.value == "" || userInput.value == ""){
          alert("Please, fill all fields before submitting.");
          return false;
        }else if(!/.{6,}/.test(passwordInput.value)){
          alert("Your password must be atleast 6 characters.");
          return false;
        }else if(passwordInput.value != repeatpwdInput.value){
          alert("Passwords must be matching.");
          return false;
        }else{
          document.getElementById("regForm").submit();
          return true;
        }
      }
    </script>
<body>
</html>
