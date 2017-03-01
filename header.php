<?php 

include 'functions.php';
  $loggedin_user = get_loggedin_username();
  $username = $loggedin_user[1];
  $profile_pic = $loggedin_user[0];
  $nickname = $loggedin_user[3];
  if ($nickname != '') {
  $username = $nickname;
}
include 'connection.php';
$query = "SELECT count(friend_id) as requests FROM friendships WHERE user_id = '".$_SESSION['user_id']."' and friend_type = 0";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$query = "SELECT count(friend_id) as friends_num FROM friendships WHERE (user_id = '".$_SESSION['user_id']."' OR friend_id = '".$_SESSION['user_id']."') and friend_type = 1";
$resultf = mysqli_query($link,$query);
$rowf = mysqli_fetch_array($resultf);

?>
<!DOCTYPE html> 
<html>

<head>
  <title>Socialize</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />

<link rel="stylesheet" type="text/css" href="css/style.css" />
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  

  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- modernizr enables HTML5 elements and feature detects -->
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="jquery.bootstrap-growl.js"></script>
  <script src="jquery.bootstrap-growl.min.js"></script>


  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="scripts_index.js"></script>



  
  <script type="text/javascript">
    $(":file").filestyle();

  </script>
</head>



<body class=" backgrnd">

<nav class="navbar navbar-custom navbar-fixed-top">
	<div class="container">

	<div class="navbar-header">
      <img src="images/global.png" class="float-to-left icon-placing">
      <a class="navbar-brand" href="home.php">Socialize</a>
    </div>
    <form class="navbar-form float-to-left" method="POST" action="search.php">
        <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" style="width: 350px;" name="search">
          <div class="input-group-addon"><button style="border: none;"><a href=""><span class="glyphicon glyphicon-search"></span></a></button></div>
         </div>
        </div>
     </form>
	<div class="pull-right">
		<ul class="nav nav-pills pull-down float-to-left">
  			<li><a href="home.php">Home</a></li>
  			<li><a href="profile.php?username=<?php echo $username;  ?>">Profile</a></li>
        <?php  //echo $_GET['username'];  ?>
  			<li><a href="###">Messages</a></li>

  			<li>
  				<a  href="notification.php"><span class="glyphicon glyphicon-globe"></span></a>
  			</li>
  			<li>
  				<a href="friends.php"><span class="glyphicon glyphicon-user"></span></a>
  			</li>

  			<li class="dropdown" id="selectt">
          	<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-menu-down"></span></a>
          	<ul class="dropdown-menu">
            	<li><a href="friends.php">Friends</a></li>
            	<li><a href="">Settings</a></li>
            	<li><a href="index.php">Log out</a></li>
          	</ul>
        	</li>
		</ul>
	</div>
	</div>
</nav>