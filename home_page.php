<?php
Include 'global.php';
$uname = "Lacie";
$pwd = "123456";

if (isset($_POST) && isset($_POST['uname']) && isset($_POST['pwd'])){
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
      $feed = getFeed($uname);
      $i = 0;
      echo '<div class="container">';
      echo "<div class = row>";
      foreach($feed as $val) {
        $user = $val['uname'];
        $tweet = $val['t_text'];
        $date = $val['t_date'];
        if ($i % 3 == 0 && $i != 0){
          echo "</div>";
          echo "<div class = row>";
        }
        echo "<div class = col>";
        $html_block = constTweetBlock($user, $tweet, $date);
        echo $html_block;
        echo "</div>";
        $i += 1;
      }
      echo "</div>";
    ?>
  </body>
 </html>
