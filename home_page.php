<?php
$servername = "localhost";
$username = "jackson";
$password = "root";
$database = "twitter";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function check_user($username, $pwd) {
    $sql = $db->prepare("SELECT * from users where uname = ? and upass = ?;");

    $sql->bind_param("ss", $uname, $upass);

    $uname = $username;

    $upass = $pwd;

    $results = $sql->exicute();

    if (count($results) != 1)
    {
      header("Location: index.php?status=1"); /* Redirect browser */
    }
}


if (isset($_POST) && isset($_POST['uname'] && isset($_POST['pwd']))){
  check_user($_POST['uname'], $_POST['pwd']);
}
?>

 <!DOCTYPE html>
 <html>
	<head>
		<title>Chit Chat</title>
		<!-- Include Bootstrap's CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
	<body>

    	<!-- DEFINE YOUR USER INTERFACE FOR YOUR CHIT CHAT CLIENT HERE. -->


		<div class="form-group">
		  <label for="comment">Your Post:</label>
		  <textarea class="form-control" rows="5" id="comment"></textarea>
		  <button onClick="postHelper()" id="postBtn">Post</button>
		  <button onClick="refresh(false)" id="refreshBtn">Refresh</button>

		</div>

		<div id="contents"> </div>

		<br>
		<center>
		<button onClick="loadMore()" id="loadMoreBtn">Load More Posts</button>
		</center>

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
