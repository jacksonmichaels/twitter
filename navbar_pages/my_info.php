<?php
include '..\global.php';

function unlike_tweet($uid, $tid){
  $sql = 'delete from likes where (tweets_tid = '.$tid.' and users_uid = '.$uid.');';
  $GLOBALS['db']->query($sql);
}

function delete_account(){
  $uid = $_SESSION['uid'];
  $rt_sql = 'delete from retweets where uid = '.$uid.' or tid in(select tid from tweets where uid = '.$uid.');';
  $likes_sql = 'delete from likes where users_uid = '.$uid.' or tweets_tid in(select tid from tweets where uid = '.$uid.');';
  $follow_sql = 'delete from followers where follower_id = '.$uid.' or followed_id = '.$uid.';';
  $tweet_sql = 'delete from tweets where uid = '.$uid.';';
  $users_sql = 'delete from users where uid = '.$uid.';';

  $GLOBALS['db']->query($rt_sql);
  $GLOBALS['db']->query($likes_sql);
  $GLOBALS['db']->query($follow_sql);
  $GLOBALS['db']->query($tweet_sql);
  $GLOBALS['db']->query($users_sql);

}

if (isset($_POST) && isset($_POST['act']) && isset($_POST['tid'])){
   if ($_POST['act'] == "unlike"){
    unlike_tweet($_SESSION['uid'], $_POST['tid']); }
  }

if (isset($_POST) && isset($_POST['act']) && $_POST['act'] = "delete_account"){
  delete_account();
  echo "<!DOCTYPE html>";
  echo "<head>";
  echo "<title>Form submitted</title>";
  echo '<script>window.top.location.href = "/";</script>';
  echo "</head>";
  echo "<body></body></html>";
}


 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>My Info</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<!-- jQuery -->
  	<script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

    <div id="user_data"  style = "position: absolute;width:40%; padding: 5%; display: block;">
      <h2> Account Information </h2>
      You are following <?php  echo num_following($_SESSION['username']); ?> users
      <br>
      You are being followed by <?php  echo num_followers($_SESSION['username']); ?> users
      <br>
      <?php
      $followed = get_followed();
      $following = get_following();
      ?>
      <div id="followed_list" style = "position: absolute;width:50%;left:0;border-style: solid; border-width: 5px">
        <h3>Users you follow</h3>
        <ul>
          <?php
          while ($row = $following->fetch_assoc()){
            echo "<li>".$row['uname']."</li>";
          }
          ?>
        </ul>
      </div>
      <div id="following_list" style = "position: absolute; left: 50%;width:50%;border-style: solid; border-width: 5px  ">
        <h3>Users following you</h3>
        <ul>
          <?php
          while ($row = $followed->fetch_assoc()){
            echo "<li>".$row['uname']."</li>";
          }
          ?>
        </ul>
      </div>
    </div>
     <div id="liked" style = "position: absolute; left: 50%;width:50%;display: block;padding-top: 5%;">
       <?php
       $feed = get_liked_tweets($_SESSION['uid']);
       ?>
       <h2 style= "text-align: center;">Liked Tweets</h2>
       <div class = "container">
         <div style ="width: 50%;">
           <?php
           foreach($feed as $val) {
             $user = $val['uname'];
             $tweet = $val['t_text'];
             $date = $val['t_date'];
             $tid = $val['tid'];
             $html_block = constTweetBlock($user, $tweet, $date, $tid, 1, '');
             echo $html_block;
           };
           ?>
         </div>
       </div>
     </div>
     <form action="my_info.php" method="post" style="position: absolute;bottom: 0;">
        <input type="hidden" name="act" value="delete_account">
        <input type="submit" value="delete_account">
     </form>
  </body>
</html>
