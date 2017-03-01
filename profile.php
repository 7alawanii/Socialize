<?php include 'header.php' ;?>
<?php include 'connection.php'; ?>
<?php 
	$counter = 0;
	if (isset($_POST['close'])) {
		$query = "DELETE FROM notification WHERE Postid = '".$_POST['post_id']."' and Ouserid = '".$_SESSION['user_id']."'";
		mysqli_query($link,$query);
		$query = "DELETE FROM likes WHERE post_id = '".$_POST['post_id']."'";
		mysqli_query($link,$query);
		$query = "DELETE FROM comments WHERE post_id = '".$_POST['post_id']."'";
		mysqli_query($link,$query);
		$query = "DELETE FROM posts WHERE post_id = '".$_POST['post_id']."'";
		mysqli_query($link,$query);
	}
	//include 'functions.php';
	//$loggedin_user = get_loggedin_username();
	//$username = $loggedin_user[1];
	//$profile_pic = $loggedin_user[0];
	if (isset($_GET['username'])) {
		if (strpos($_GET['username'], ' ') == true) {
			$split = explode(' ', $_GET['username']);
			$fname = $split[0];
			$lname = $split[1];

		}else{
			$fname = '';
			$lname = '';
		}
		$username = $_GET['username'];
		$query = "SELECT * from users where (user_fname = '".$fname."' and user_lname = '".$lname."') OR user_nname = '".$_GET['username']."'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
		$flag = 1;
		$friends = NULL;
		if ($row['user_id'] == $_SESSION['user_id']) {
			$flag = 1;	// opened my profile.
		}else{
			$flag = 0;		// opened some one others profile.
			$query = "SELECT friend_type from friendships where (user_id = '".$_SESSION['user_id']."' and friend_id = '".$row['user_id']."') OR (friend_id = '".$_SESSION['user_id']."' and user_id = '".$row['user_id']."')";
			$result = mysqli_query($link,$query);
			$rowf = mysqli_fetch_array($result);
			$friend_id = $row['user_id'];
			$num = mysqli_num_rows($result);
			$friends = NULL;
			if ($rowf['friend_type'] == 1 && $num > 0) {
				$friends = 1;	//my friend profile.
			}elseif($rowf['friend_type'] == 0 && $num > 0){
				$friends = 0;	//not friends but there is a friendrequest sent.
			}elseif($num == 0){
				$friends = 2;  //not friends and no friend request sent.
			}
			$query = "SELECT p.picture_path FROM pictures as p inner join users as u on u.user_profile_picture = p.picture_id WHERE u.user_id = '".$friend_id."'";
			$result = mysqli_query($link , $query);
			$rowff = mysqli_fetch_array($result);
			$profile_pic = 'images/'.$rowff[0];
			//$username = $rowff[1].' '.$rowff[2];
		//$loggedin_user[2] = $rowff[0];
		}
	}
	if (isset($_POST['post']) && $flag== 1) {
		posting();
	}
?>


	<div id="covering">
	<div class="container">
	<?php if ($flag == 1) { ?>
		
		<form method="post" action="friends.php">
		<button class="btn btn-placing pull-right" type="Submit" >
			Friend
		</button>
		
		</form>
		<form method="post" action="Requests.php">
		<button class="btn btn-placing pull-right" type="Submit">
			Show Requests
		</button>
		</form>
		<form method="post" enctype="multipart/form-data">
		<button class="btn btn-placing pull-right" type="Submit" name="upload">UPDATE</button>
		<label class="btn btn-placing pull-right">
    			Upload Profile Picture <input type="file" style="display: none;" name="profilepic">
		</label>
		</form>
		<?php }elseif($flag == 0 && $friends == 1){ ?>
		<form method="post" enctype="multipart/form-data" action="friendrequests.php">
			<input type="submit" class="btn pull-right" style="margin-top: 200px;" name="Decline_profile" value="Delete"/>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]; ?>"></input>
            <input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>"></input> 
            <input type="hidden" value="<?php echo $username; ?>" name="username">
		</form>
		<?php }elseif($flag == 0 && $friends == 0){ ?>
		<form method="post" enctype="multipart/form-data" action="Requests.php">
			<button class="btn btn-placing pull-right" style="margin-top: 200px;">There is a friend Request.</button>
		</form>
		<?php }elseif($flag == 0 && $friends == 2){ ?>
		
		<form method="post" enctype="multipart/form-data" action="addFriend.php">
			<button class="btn btn-placing pull-right" id="add" style="margin-top: 200px;" name="AddFriend">
								Add Friend +
							</button>
							<input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id">
							<input type="hidden" value="<?php echo $friend_id; ?>" name="friend_id">
							<input type="hidden" value="<?php echo $username; ?>" name="username">
		</form>
		
		<?php } ?>
		<?php 
		if (isset($_POST['upload']) && $flag == 1 && $friends == NULL) {

				upload_profile_picture();
				$loggedin_user = get_loggedin_username();
				$username = $loggedin_user[1];
				$profile_pic = $loggedin_user[0];
			
		}

		?>


<img id="myImg" src="<?php echo $profile_pic; ?>" class="img-properties" alt="Trolltunga, Norway" >

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <button type="submit" class="close close-pic" onclick="document.getElementById('myModal').style.display='none'" style="color: white; opacity: 0.9;">x</button>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

  		<!--<img src="<?php //echo $profile_pic; ?>" class="img-properties" alt="ProfilePicture">-->
		<span class="username"><?php  echo $username; ?></span>
	</div>
	</div>

	<div class="container">
	<div class="row">
	<?php  if ($flag == 1 || ($flag == 0)) {
		
	} ?>
	<?php  
	if ($flag == 1) {
		$query = "SELECT * FROM users WHERE user_id = '".$_SESSION['user_id']."'";
	}else{
		$query = "SELECT * FROM users WHERE user_id = '".$friend_id."'";
	}
	
	$result = mysqli_query($link,$query);
	$info = mysqli_fetch_array($result);
	 ?>
	<div class="col-md-3" style="position : top;">
        <table class="nav bs-sidenav table table-hover" id="sidebar-content">
        
        <?php 
        if($info['user_fname']!= '') {
        	echo '<tr><td><p>First name : ';
        	echo $info['user_fname'].'</p></td></tr>';}
         if($info['user_lname']!= '') {
        	echo '<tr><td><p>Last name : ';
        	echo $info['user_lname'].'</p></td></tr>';
        } 
        if($info['user_nname']!= '') {
        	echo '<tr><td><p>Nick name : ';
        	echo $info['user_nname'].'</p></td></tr>';}
        if($info['user_email']!= '') {
        	echo '<tr><td><p>Email : ';
        	echo $info['user_email'].'</p></td></tr>';}
        if($info['user_hometown']!= '') {
        	echo '<tr><td><p>Hometown : ';
        	echo $info['user_hometown'].'</p></td></tr>';}

        	if($info['user_marital']!= '') {
        	echo '<tr><td><p>Marital Status : ';
        	echo $info['user_marital'].'</p></td></tr>';}

        if ($flag == 1) {
        	if($info['user_birthdate']!= '') {
        	echo '<tr><td><p>Your Birthdate : ';
        	echo $info['user_birthdate'].'</p></td></tr>';}
        	if($info['user_birthdate']!= '') {
        	echo '<tr><td><p>About You : ';
        	echo $info['user_about'].'</p></td></tr>';}
        }

        $query = "SELECT phone_number FROM phones WHERE user_id = '".$_SESSION['user_id']."'";
		$result = mysqli_query($link,$query);
		while($phones = mysqli_fetch_array($result)){
			if($phones['phone_number']!= '') {
        	echo '<tr><td><p>Phone Number :';
        	echo $phones['phone_number'].'</p></td></tr>';}
		}

        ?>
        

        </table>
        </div>
		<div class="col-md-6">
			<ul>
				<li>
				<?php if ($flag == 1) {?>
					<div>
						<img src="<?php echo $profile_pic; ?>" class="profile" class="float-to-left">
						<a class="Username" href="profile.php?username=<?php  echo $username; ?>"><?php  echo $username; ?></a>
						<form method="post" enctype="multipart/form-data">
  						<div class="input-group">
    						<input class="form-control" type="text" id="posttext" name="posttext" placeholder="What's on your mind today ?">
    						<div class="input-group-addon">
    							<a href=""><span class="glyphicon glyphicon-paperclip"></span></a>
    						</div>
    					</div>
    					<br>
    					<div class="float-to-left">
    						<button class="btn" name="post" value="posting">post</button>
  						</div>
  						<div class="float-to-left" style="margin-left: 5px; margin-right: 5px;">
  							
  							<select name="privacy" class="selectpicker" data-width="100px" data-style="btn" title="Privacy">
  							<option value="public">Public</option>
  							<option value="private">Private</option>
  						</select>
    							<!--<a href=""><span class="glyphicon glyphicon-paperclip"></span></a>-->
  						</div>
  						
  						<label class="btn">
    						Upload Picture<input type="file" style="display: none;" name="postimage">
						</label>
					</form>
					</div>
					<?php  }?>
					
				</li>
				<?php
				if ($flag == 1) {
				
					$query = "SELECT * FROM posts as p left join pictures as pi on pi.picture_id = p.post_picture_id WHERE user_id = '".$_SESSION['user_id']."' ORDER BY p.post_timestamp DESC";
				}elseif($flag == 0 && $friends == 1){
					$query = "SELECT * FROM posts as p left join pictures as pi on pi.picture_id = p.post_picture_id WHERE user_id = '".$friend_id."' ORDER BY p.post_timestamp DESC";
				}elseif($flag == 0 && ($friends == 0 || $friends == 2)){
					$query = "SELECT * FROM posts as p left join pictures as pi on pi.picture_id = p.post_picture_id WHERE user_id = '".$friend_id."' and p.post_privacy = 1 ORDER BY p.post_timestamp DESC";
				}
				$result = mysqli_query($link,$query);
				
				while ($row = mysqli_fetch_array($result)){
					$postpic = 'images/'.$row["picture_path"];
					echo '<hr>
				
				<li>
					<div>

						<img src="'.$profile_pic.'" class="profile float-to-left">
						<a class="Username float-to-left">'.$username.'</a>';
						if ($flag == 1) {
						echo '
						<form method="post" class="form float-to-left pull-right">
							<button class="btn delete-post" type="submit" name="close">x</button>
							<input type="hidden" name="post_id" value="'.$row["post_id"].'">
						</form>';
						}

						echo'<br><br><br>
						<div class="timestamp" style="margin-top="20px;">
								<span>'.$row["post_timestamp"].'</span>
							</div>';
						if ($row['is_image'] == '1') {
							
								echo '<div>
								<img src="'.$postpic.'" style="height : 380px; width: 400px;"/>
								</div><br>';
							}
							echo '<div><p>'.$row["post_text"].'</p></div>';
						
					

				if ($flag == 1 || ($flag == 0 && $friends == 1)) {
					echo '<hr>
						<form class="form">
							<a href="" class="comment-like like" id="'.$row[0].'"><span class="glyphicon glyphicon-thumbs-up">  Like</span></a>
							<hr>
							<div class="input-group">
							<div class="input-group-addon"><a href=""><span class="glyphicon glyphicon-comment"></span></a></div>
							<input type="text" name="comment" class="form-control">
							</div>
						</form>
					</div>
				</li>';
				}

				}

				
				?>
				</ul>
				</div>
	</div>
		
	</div>


  <script language='javascript' type='text/javascript'>
  
  // Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}



   var notif1;
  var notif2;

  function AJAXnot(){
	  var data;
	  $.ajax({
			type : 'GET',
			url : 'chknotif.php',
			data : {},
			async: false,
			success : function(response){
				
				data = response;
				
				}
		});
		return data;
	 
  }
  
  function setnotify(){
  
  notif1=AJAXnot();
 
  }
  

  function chknotif()
  {
	  
	  notif2= AJAXnot();
	  $(function(){
        setTimeout(function() {
        $.bootstrapGrowl("chk NOTIFICATION!", {
            type: 'danger',
            align: 'center',
            width: 'auto',
            allow_dismiss: false
        });
    }, 2000);
    });
	
	//alert("N@"+notif2);
	
	if(notif2>notif1)
	{
		alert("NEW");
		


      $(function(){
        setTimeout(function() {
        $.bootstrapGrowl("NEW NOTIFICATION!", {
            type: 'danger',
            align: 'center',
            width: 'auto',
            allow_dismiss: false
        });
    }, 2000);
    });
      alert ("DONE");    

		notif1=notif2;
	}
	else 
	{
	}
	
  }
  
  
  
  
  
  function call(){
	  setnotify();
	  setInterval(chknotif, 500);
  }
  
  
</script>
<script>call();</script>

</body>


</html>