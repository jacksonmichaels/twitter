<?php
Include 'global.php';
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign-In</title>
  <!-- Include Bootstrap's CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <form id = "sign_div" action="home_page.php" method="post">
    <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>
      <br>
      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" required>
      <br>
      <button type="submit">Login</button>
  </form>
  <p style="position: absolute;left:40%;top:35%;color:red;">
  <?php
    if ($_GET['status'] == 1){
      echo "That login does not exist, please try again";
    }
   ?>
 </p>
</body>
</html>
