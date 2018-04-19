<?php
Include 'global.php';

if (isset($_POST) && isset($_POST['uname']) && isset($_POST['pwd'])){
  $valid = check_user($_POST['uname'], $_POST['pwd']);
  if (!$valid) {
    header("Location: index.php?status=1"); /* Redirect browser */
  }
}


?>

 <!DOCTYPE html>
 <html>
	<head>
    <title>PHP Test</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>
    <div id = "head">
      <h1>Twitter Clone

        <?php
          if (isset($_POST['act'])) {
            echo "Hello world!";
            echo $_POST['act']; //Your code here
          };
        ?></h1>
    </div>

    <div id = "user_panel">
      <header>
        Username: <?php echo $_SESSION['username']; ?>
      </header>
      <div>
        Followers: <?php  echo num_followers($_SESSION['username']); ?>
        <br>
        Likes: <?php echo num_likes($_SESSION['username']); ?>
      </div>
    </div>

    <div id="body_panel">
    <?php
      $feed = getFeed($_SESSION['username']);
      $i = 0; ?>
      <h2 style= "text-align: center;">Timeline</h2>
      <div class = "container">
        <div class = "row">
          <?php
          foreach($feed as $val) {
            $user = $val['uname'];
            $tweet = $val['t_text'];
            $date = $val['t_date'];
            $tid = $val['tid'];
            $liked = check_liked($_SESSION['uid'], $tid);
            if ($i % 3 == 0 && $i != 0){
              echo "</div>";
              echo "<div class = row>";
            }
            $html_block = constTweetBlock($user, $tweet, $date, $tid, $liked);
            echo $html_block;
            $i += 1;
          };
          ?>
      </div>
    </div>
    <iframe  name="act_frame"></iframe>
  </body>
 </html>
