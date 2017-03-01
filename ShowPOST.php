<?php include 'header.php' ; ?>

<div class="container">
	<div class="row">
	<div class="col-md-3" style="position : fixed;">
        <table class="nav bs-sidenav table table-hover" id="sidebar-content">
        <tr><td><a href="home.php">Home</a></td></tr>
        <tr><td><a href="profile.php">Profile</a></td></tr>
        <tr><td><a href="">Edit Profile</a></td></tr>
        <tr><td><a href="">Friends</a></td></tr>
        <tr><td><a href="Requests.php">Friend Requests</a></td></tr>
        <tr><td><a href="">Messages</a></td></tr>
        <tr><td><a href="">Photos of you</a></td></tr>

        </table>
        </div>
		<div class="col-md-6 col-md-offset-3">

			<ul>
				<li>
					<div>
						<h5></h5>
						<?php 
						include 'connection.php';
						
						$POSTID=$_GET['varname'];
						//echo $_SESSION['user_id'];
                        echo $POSTID;
						$query = ("SELECT * from posts where user_id='".$_SESSION['user_id']."' and post_id='".$POSTID."'");

                        $result = mysqli_query($link , $query);



                        $results = mysqli_num_rows($result);
						//echo $results."hhhhhhhhhhhhhhhhhhh";
						

		                if($results > 0){
							
							$row=mysqli_fetch_array($result);
						
						$query1 = ("SELECT user_fname,user_lname,p.picture_path from users 
						Inner Join pictures as p ON users.user_profile_picture=p.picture_id where user_id='".$_SESSION['user_id']."' ");

                        $result1 = mysqli_query($link , $query1);



                        $results1 = mysqli_num_rows($result1);
						//echo $results."hhhhhhhhhhhhhhhhhhh11";
						$row1=mysqli_fetch_array($result1);
						//print_r($row1);
						$fname=$row1['user_fname'];
						$lname=$row1['user_lname'];
						$Upic='images/'.$row1['picture_path'];
						$FULLNAME=ucfirst($fname)." ".ucfirst($lname);
						//echo "<br/>".$FULLNAME."<br/>";
                        echo '
					<li>
					  <div>
					      <img src="'.$Upic.'" class="profile">
						   <a href="profile.php" >'.$FULLNAME.'        ('.$row['post_timestamp'].')</a><br/> <br/>
						   <span>  '.$row['post_text'].' </span> 
						   
					  </div>   ';
					  
						}
						
						$query1 = ("SELECT u.user_fname,u.user_lname,p.picture_path from likes
						Inner join users as u ON u.user_id=likes.user_id 
						Inner join pictures as p on u.user_profile_picture = p.picture_id
						where post_id='".$POSTID."' 
						ORDER BY likes.like_timestamp");

                        $result1 = mysqli_query($link , $query1);



                        $results1 = mysqli_num_rows($result1);
						$likers=" ";
						$row12=mysqli_fetch_array($result1);
						$lUpic='images/'.$row12['picture_path'];
						$FULLNAME_liker=ucfirst($row12['user_fname'])." ".ucfirst($row12['user_lname']);
						$likers=$FULLNAME_liker;
						while($row1=mysqli_fetch_array($result1))
						{
						$FULLNAME_liker=ucfirst($row1['user_fname'])." ".ucfirst($row1['user_lname']);
						$likers=$likers.",".$FULLNAME_liker;

						}
						//echo $likers;
 						echo '
					<li>
					  <div>
					      <img src="'.$lUpic.'" class="profile">
						   
						   <span>  '.$likers.' liked your post </span> 
						   
					  </div>   ';
					  
					  
					  $query1 = ("SELECT u.user_fname,u.user_lname,p.picture_path,c.comment_text from comments as c 
					  INNER JOIN users as u ON u.user_id = c.user_id 
					  INNER JOIN pictures as p On p.picture_id=u.user_profile_picture
					  where c.post_id= '".$POSTID."' 
					  ORDER BY c.comment_timestamp ASC");

                        $result1 = mysqli_query($link , $query1);



                        $results1 = mysqli_num_rows($result1);
						
						if($results1>0)
							
						{
							while($row1=mysqli_fetch_array($result1))
							{
								$fname=$row1['user_fname'];
								$lname=$row1['user_lname'];
								$UFULLN=$fname." ".$lname;
								$comment=$row1['comment_text'];
								$upic='images/'.$row1['picture_path'];
								echo '
					<li>
					  <div>
					      <img src="'.$Upic.'" class="profile">
						   <a href="profile.php" >'.$UFULLN.'</a><br/> <br/>
						   <span>  '.$comment.' </span> 
						   
					  </div>   ';
								
							}
							
							
						}
					  
					  

						



						  ?>
						
					</div>
				</li>
	</ul>
</div>
</div>
</div>
</body>
</html>