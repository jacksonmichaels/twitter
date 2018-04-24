<?php
$DB_CON = array(
"server_name" => "localhost",
"username" => "jackson",
"password" => "root",
"database" => "twitter",
);

// Create connection
$db = new mysqli($DB_CON["server_name"], $DB_CON["username"], $DB_CON["password"], $DB_CON["database"]);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function check_user($username, $pwd) {
  $query = "SELECT * FROM `users` WHERE uname='$username'and upass='".$pwd."'";
	$result = mysqli_query($GLOBALS['db'],$query);
	$rows = mysqli_num_rows($result);
  mysqli_free_result($result);
  if($rows==1){
    $_SESSION['username'] = $username;
    $_SESSION['uid'] = getUid($username);
	    return true;
    } else {
      return false;
    }
}

function getAssoc($query){
  if ($result = $GLOBALS['db']->query($query)) {
    $ret_val = $result->fetch_array(MYSQLI_ASSOC);
    /* free result set */
    $result->close();
  }
  return $ret_val;
}

function getUid($user) {
  $query = "select * from users where uname = ".$user.";";
  if ($result = $GLOBALS['db']->query('SELECT uid FROM users WHERE uname = "root"')) {
    $uid = $result->fetch_array(MYSQLI_ASSOC)['uid'];
    /* free result set */
    $result->close();
  }
  return $uid;
}

function getFeed($user) {
  $uid = getUid($user);
  $query = '
  select uname,  NULL as "r_name", t_text, t_date, t.tid as "tid"
  	from tweets t join
  		(select followed_id from followers where follower_id = '.$uid.') a on t.uid = a.followed_id
  			join users u on u.uid = a.followed_id
  union
  select u.uname, ur.uname, t.t_text, r.t_date, r.tid as "tid"
    from retweets r join
      (select followed_id from followers where follower_id = '.$uid.') f on f.followed_id = r.uid
    		join tweets t on t.tid = r.tid
    			join users u on r.uid = u.uid
    				join users ur on ur.uid = t.uid
    		order by t_date;';
  $result = $GLOBALS['db']->query($query);
  $return_val =  resultToArray($result);
  $result->close();
  return $return_val;
}

function constTweetBlock($user, $text, $date, $tid, $liked, $rt_name){
  if ($liked == 1){
    $act = "unlike";
  } else {
    $act = "like";
  }

  if ($rt_name) {
    $rt_message = "Retweet from: ".$rt_name;
  } else {
    $rt_message = '';
  }
  $html = '
    <div class="w3-card-4 tweet_card" id="tweet_'.$tid.'">
      <header class="w3-container w3-blue">
        <h1 style="display:inline">'.$user.' '.$tid.'</h1>
        <h2 style="display:inline" class="tweet_like">'.$rt_message.'</h2>
      </header>

      <div class="w3-container">
        <p>'.$text.'</p>
      </div>

      <footer class="w3-container w3-blue">
        '.$date.'
        <form action="home_page.php" method="post" class="tweet_like">
           <input type="hidden" name="act" value="'.$act.'" />
           <input type="hidden" name="tid" value="'.$tid.'" />
           <input type="submit" value="'.$act.'">
        </form>
      </footer>
    </div>
    <br>';
  return $html;
}

function num_followers($uname) {
  $uid =  getUid($uname);
  $num = getAssoc(
    'select count(*) as "num"
    	from users u
    		where u.uid in (
    			select followed_id from followers where follower_id = "'.$uid.'");'
    );

    return $num['num'];
}

function num_likes($uname) {
  $uid =  getUid($uname);
  $num = getAssoc(
    'select count(*) as "num" from tweets t join likes l on t.tid = l.tweets_tid join users u on t.uid = u.uid where u.uid = "'.$uid.'";'
    );

    return $num['num'];
}

function check_liked($uid, $tid){
  $query = 'SELECT count(*) as "num" FROM likes WHERE tweets_tid = "'.$tid.'" and users_uid = "'.$uid.'"';
  if ($result = $GLOBALS['db']->query($query)) {
    $num = $result->fetch_array(MYSQLI_ASSOC)['num'];
    /* free result set */
    $result->close();
  }
  return $num;
}
?>
