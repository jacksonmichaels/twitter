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
function getAssoc($query){
  $result = $GLOBALS['db']->query($query);
  return $result;
}

function getUid($user) {
  $query = "select uid from users where uname = $user;";
  $result = $GLOBALS['db']->query($query);
  return $result[uid];
}

function getFeed($user) {
  $uid = getUid($user);
  $query = "
  select uname, t_text, t_date
	from tweets t join
		(select followed_id from followers where follower_id = 1) a on t.uid = a.followed_id
			join users u on u.uid = a.followed_id
  union
  	select uname, t_text, r.t_date
  		from retweets r join (select followed_id from followers where follower_id = 1) a on r.uid = a.followed_id
  			join tweets t on r.tid = t.tid
  				join users u on u.uid = r.uid
  		order by t_date;";
  $result = $GLOBALS['db']->query($query);
  return $result;
}

function constTweetBlock($user, $text, $date){
  $html = '
    <div class="w3-card-4 tweet_card">
      <header class="w3-container w3-blue">
        <h1>'.$user.'</h1>
      </header>

      <div class="w3-container">
        <p>'.$text.'</p>
      </div>

      <footer class="w3-container w3-blue">
        <h5>'.$date.'</h5>
      </footer>
    </div>
    <br>';
  return $html;
}
?>
