<?php
Include 'global.php';
function like_tweet($uid, $tid){
  $sql = 'insert into likes values('.$tid.','.$uid.');';
  $GLOBALS['db']->query($sql);
}

function unlike_tweet($uid, $tid){
  $sql = 'delete from likes where (tweets_tid = '.$tid.' and users_uid = '.$uid.');';
  $GLOBALS['db']->query($sql);
}


if (isset($_POST) && isset($_POST['act']) && isset($_POST['tid'])){
  if ($_POST['act'] = "like"){
    like_tweet($_SESSION['uid'], $_POST['tid']);
  } else if ($_POST['act'] = "unlike"){
    unlike_tweet($_SESSION['uid'], $_POST['tid']);
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
  echo $_POST['act'];
  echo $_POST['tid'];
 ?>

 <script>
//  window.top.location.reload();

 </script>
</body>

</html>
