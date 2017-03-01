<?php include 'header.php' ; 
include 'connection.php';
?>
<div class="container">
	<div class="row">
	<div class="col-md-3" style="position : fixed;">
        <ul class="list-group">
        	<li class="list-group-item">
        		<a href="home.php">Home</a>
        	</li>
        	<li class="list-group-item">
        		<a href="profile.php?username=<?php echo $username;  ?>">Profile</a>
        	</li>
        	<li class="list-group-item">
        		<a href="editprofile.php">Edit Profile</a>
        	</li>
        	<li class="list-group-item">
        		<a href="friends.php">Friends<span class="badge pull-right"><?php echo $rowf['friends_num'];  ?></span></a>
        	</li>
        	<li class="list-group-item">
        		<a href="Requests.php">Friend Requests<span class="badge pull-right"><?php echo $row['requests'];  ?></span></a>
        	</li>
        	<li class="list-group-item">
        		<a href="">Messages</a>
        	</li>
        	<li class="list-group-item">
        		<a href="">Photos of you</a>
        	</li>
        </ul>
        </div>
		<div class="col-md-6 col-md-offset-3">

			<ul>
				<li>
					<div>
						<h5>Respond to some Friend Requests</h5>
					</div>
				</li>
	<?php


// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 
$friendsQuery='SELECT concat(u.user_fname," ",u.user_lname)as name,f.user_id,f.friend_id,p.picture_path from friendships f
inner join users u on f.friend_id=u.user_id
inner join pictures p on u.user_profile_picture=p.picture_id
where f.user_id='.$_SESSION['user_id'].' and f.friend_type=0';
$result =$link->query($friendsQuery);

    while ($row = $result->fetch_assoc()) {
			$profile_pic = 'images/'.$row["picture_path"];
			echo'<li>
					<div>
					<form action="friendrequests.php" method="post">
						<img src="'. $profile_pic.' " class="request">
						<a class="Username" href="profile.php?username='.$row['name'].'">'.$row['name'].'</a>
					<input type="submit" name="Accept" 	value="Accept" class="btn btn-margin pull-right"></input>
					<input type="submit" name="Decline" value="Decline" class="btn btn-mar pull-right" ></input>
					<input type="hidden" name="user_id" value="'.$row["user_id"].'"></input>
					<input type="hidden" name="friend_id" value="'.$row["friend_id"].'"></input>
					</form>
					</div>
				</li>'; 
    }
?>

	
								</ul>
				</div>
				<div class="col-md-3 col-md-offset-8 info-requests" style="position : fixed;">
					<h4>Friend Requests</h4>
					<hr>
        	    	<p>Here are  some people you may know , want to be your friend. You may Accept or Decline their request !!<br> Don't make them wait <i class="em em-innocent"></i></p>

        	    </div>
	</div>
</div>

  <script language='javascript' type='text/javascript'>
  
  
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