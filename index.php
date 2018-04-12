<?php
$servername = "localhost";
$username = "jackson";
$password = "root";
$database = "twitter";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $db->query("SELECT uid, uname, upass FROM users")
?>

 <!DOCTYPE html>
 <html>
  <head>
   <title>PHP Test</title>
  </head>
  <body>
    <?php
      echo "<table>";
      echo "<tr><th>ID</th><th>Username</th><th>Password</th></tr>";

      while($row = mysqli_fetch_array($result)) {
          $id = $row['uid'];
          $uname = $row['uname'];
          $upass = $row['upass'];
          echo "<tr><td>".$id."</td><td>".$uname."</td><td>".$upass."</td></tr>";
      }

      echo "</table>";
    ?>
  </body>
 </html>
