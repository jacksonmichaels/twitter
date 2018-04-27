<?php
include '..\global.php';
if (isset($_POST) && isset($_POST['text'])){
  send_tweet($_POST['text']);
  echo "<!DOCTYPE html>";
  echo "<head>";
  echo "<title>Form submitted</title>";
  echo "<script type='text/javascript'>window.parent.location.reload()</script>";
  echo "</head>";
  echo "<body></body></html>";
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Make Tweet</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<!-- jQuery -->
  	<script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <textarea rows="4" cols="50" name="text" form="tweet_form" placeholder="Type Tweet Here" style="width: 100%; height: 85vh;"></textarea>
    <form action="make_tweet.php" method = "post" id="tweet_form">
      <input type="hidden" name="act" value="tweet" />
      <input type="submit">
    </form>
  </body>
</html>
