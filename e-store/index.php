<?php
  session_start();

  if(!$_SESSION['username'])
    die(header("location:login.php"));
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
  <a href="logout.php" class="btn">Sign out of <?php echo htmlspecialchars($_SESSION['username']); ?></a>
  </div>
</body>
</html>
