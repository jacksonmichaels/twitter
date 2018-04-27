<?php
include '..\global.php';
if (isset($_POST) && isset($_POST['uid']) && isset($_POST['act'])){
  if ($_POST['act'] = "follow"){
    follow($_POST['uid']);
  } else if ($_POST['act'] = "unfollow"){
    unfollow($_POST['uid']);
  }
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
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
         <?php
         $users = getUsers();
         foreach($users as $val) {
           $user = $val['uname'];
           $uid = $val['uid'];
           $following = check_following($uid);
           if ($following == 1){
             $follow = "unfollow";
           } else {
             $follow = "follow";
           }
           $html = '
             <div class="w3-card-4 tweet_card" id="user_'.$uid.'">
               <header class="w3-container w3-blue">
                 <h1 style="display:inline">'.$user.' '.$uid.'</h1>
                 <form action="search_users.php" method="post" class="tweet_like">
                    <input type="hidden" name="act" value="'.$follow.'" />
                    <input type="hidden" name="uid" value="'.$uid.'" />
                    <input type="submit" value="'.$follow.'">
                 </form>
               </header>
             </div>
             <br>';
           echo $html;
         };
         ?>
 </body>
 </html>
