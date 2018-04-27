<?php

/*
TODO:
  Tweet [done]
  Delete your tweet [still working on it]
  follow user [done]
  stop following user [still working on it]
  see liked tweets
  see all users i am following
  see all users following me
  how many likes per tweet
  how many retweets per tweet
  how many users i am following
*/
Include 'global.php';

if (isset($_POST) && isset($_POST['uname']) && isset($_POST['pwd'])){
  $valid = check_user($_POST['uname'], $_POST['pwd']);
  if (!$valid) {
    header("Location: index.php?status=1"); /* Redirect browser */
  }
}

function like_tweet($uid, $tid){
  $sql = 'insert into likes values('.$tid.','.$uid.');';
  $GLOBALS['db']->query($sql);

}

function unlike_tweet($uid, $tid){
  $sql = 'delete from likes where (tweets_tid = '.$tid.' and users_uid = '.$uid.');';
  $GLOBALS['db']->query($sql);
}

$worked = "naaa man";
if (isset($_POST) && isset($_POST['act']) && isset($_POST['tid'])){
  if ($_POST['act'] == "like"){
    like_tweet($_SESSION['uid'], $_POST['tid']);
  } else if ($_POST['act'] == "unlike"){
    unlike_tweet($_SESSION['uid'], $_POST['tid']);
  } else if ($_POST['act'] == "delete") {
    $worked = delete_tweet($_POST['tid']);
    $worked = "yeah man";

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
    <nav class="navbar navbar-default" id = "head">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Twitter Clone</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="#" id = "tweet_button">Tweet</a></li>
          <li><a href="#" id = "find_user_button">Find User</a></li>
          <li><a href="#" id = "liked_tweets_button">Liked Tweets</a></li>
          <li><a href="#" id = "user_info_button">User Information</a></li>
        </ul>
      </div>
    </nav>

    <div id = "user_panel">
      <header>
        Username: <?php echo $_SESSION['username'];
                    echo $_POST['act'];
                    echo $_POST['tid'];
                    echo $worked?>
      </header>
      <div>
        Followers: <?php  echo num_followers($_SESSION['username']); ?>
        <br>
        Likes: <?php echo num_likes($_SESSION['username']); ?>
        <br>
        UID: <?php echo $_SESSION['uid'] ?>
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
            $rt_name = $val['r_name'];
            $html_block = constTweetBlock($user, $tweet, $date, $tid, $liked, $rt_name);
            echo $html_block;
            $i += 1;
          };
          ?>
      </div>
    </div>
    <script>
      $("#tweet_button").click(function(){
          $("#make_tweet_frame").toggle();
          $("#info_frame").hide();
          $("#likes_frame").hide();
          $("#users_frame").hide();
      });
      $("#find_user_button").click(function(){
        $("#make_tweet_frame").hide();
        $("#info_frame").hide();
        $("#likes_frame").hide();
        $("#users_frame").toggle();
      });
      $("#liked_tweets_button").click(function(){
        $("#make_tweet_frame").hide();
        $("#info_frame").hide();
        $("#likes_frame").toggle();
        $("#users_frame").hide();
      });
      $("#user_info_button").click(function(){
        $("#make_tweet_frame").hide();
        $("#info_frame").toggle();
        $("#likes_frame").hide();
        $("#users_frame").hide();
      });


    </script>
    <iframe src="navbar_pages/make_tweet.php" id = "make_tweet_frame"></iframe>
    <iframe src="navbar_pages/my_info.php" id = "info_frame"></iframe>
    <iframe src="navbar_pages/my_likes.php" id = "likes_frame"></iframe>
    <iframe src="navbar_pages/search_users.php" id = "users_frame"></iframe>

  </body>
 </html>
