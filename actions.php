<?php
$word = "none";
Include 'global.php';
function like_tweet($uid, $tid){
  $word = $uid;
  $sql = 'insert into likes values('.$tid.','.$uid.');';
  $success = $GLOBALS['db']->query($sql);

}

function unlike_tweet($uid, $tid){
  $sql = 'delete from likes where (tweets_tid = '.$tid.' and users_uid = '.$uid.');';
  $success = $GLOBALS['db']->query($sql);
  $word = $success;
}


if (isset($_GET) && isset($_GET['act']) && isset($_GET['tid'])){
  if ($_GET['act'] == "like"){
    like_tweet($_SESSION['uid'], $_GET['tid']);
  } else if ($_GET['act'] == "unlike"){
    unlike_tweet($_SESSION['uid'], $_GET['tid']);
  }
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<?php
  echo $_GET['act'] == "like";
  //echo $_GET['tid'];
  echo $word;
 ?>

 <script>
//  window.top.location.reload();

 </script>
</body>

</html>
