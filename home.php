<?php include 'header.php'; ?>
<?php include 'connection.php';?>
<?php
	if (isset($_POST['post'])) {
		posting();
	}

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
						<img src="<?php echo $profile_pic; ?>" class="profile" class="float-to-left">
						<a class="Username" href="profile.php?username=<?php echo $username; ?>"><?php  echo $username; ?></a>
						<form method="post" enctype="multipart/form-data">
  						<div class="input-group">
    						<input class="form-control" type="text" id="posttext" name="posttext" placeholder="What's on your mind today ?">
    						<div class="input-group-addon">
    							 
    							<a href=""><span class="glyphicon glyphicon-paperclip"></span></a>
    						</div>
    					</div>
    					<br>
    					<div class="float-to-left">
    						<button class="btn" name="post" value="posting"> Post</button>
  						</div>
  						<div class="float-to-left" style="margin-left: 5px; margin-right: 5px;">
  							
  							<select name="privacy" class="selectpicker" data-width="100px" data-style="btn" title=" Privacy">
  							<option value="public"> Public</option>
  							<option value="private"> Private</option>
  						</select>
    							<!--<a href=""><span class="glyphicon glyphicon-paperclip"></span></a>-->
  						</div>
  						
  						<label class="btn">
    						Browse <input type="file" style="display: none;" name="postimage">
						</label>
					</form>
					
					</div>
				</li>
				<?php

						$posts = show_posts();
						if (count($posts) == 0) {
							echo '<div class="alert alert-warning" role="alert"><strong>No posts to show !!</strong></div>';
						}else{
							$counter = 0;
							foreach ($posts as $post) {
							$query = "SELECT user_fname , user_lname , picture_path,user_nname FROM users as u inner join posts as po on po.user_id = u.user_id inner join pictures as pi on pi.picture_id = u.user_profile_picture WHERE po.user_id = '".$post["user_id"]."'";
							$result = mysqli_query($link,$query);
							$rows = mysqli_fetch_array($result);
							$profile_pic = 'images/'.$rows[2];
							if ($rows['user_nname'] == '') {
							$username = $rows[0].' '.$rows[1];
							}else{
								$username = $rows['user_nname'];
							}

							$postpic = "";
							$postpic = 'images/'.$post["picture_path"];
							echo'
							<li>
								<div>
									<img src="'.$profile_pic.'" class="profile">
									<a class="Username" href="profile.php?username='.$username.'">'.$username.'</a>
									<div class="timestamp">
									<span class="post-timestamp">'.$post["post_timestamp"].'</span>
								</div>';
							if ($post['is_image'] == '1') {
								echo '<div>

								<img src="'.$postpic.'" style="height : 380px; width: 400px;"/>
								</div><br>';
							}
							echo '<div><p>'.$post["post_text"].'</p></div>';

							$query2 = "SELECT Count(`post_id`) FROM likes WHERE user_id ='".$_SESSION['user_id']."' AND post_id = '".$post['post_id']."'";
							$result2 = mysqli_query($link,$query2);
							$result2 = mysqli_fetch_array($result2);
							$result2 = $result2[0];
							$comments = show_comments($post['post_id']);
  
							if($result2 == 0){
								echo '<hr>
								<form class="form" method="POST">
									<p><a href="" class="comment-like like" id="'. $post['post_id'].'" onclick="like_add('. $post['post_id'].');"><span class="glyphicon glyphicon-thumbs-up">  Like</span></a><br></br><span id="post_'. $post['post_id'].'_likes"> '.$post["number_likes"].'</span> Liked This.</p>
								<hr>';
								
									echo'<div class="input-group">
									<input type="text" name="comment" class="form-control"  id="comment_'.$post['post_id'].'" placeholder = "Write a comment...">
									<div class="input-group-addon"><a href="" onclick="add_comment('.$post['post_id'].');"><span class="glyphicon glyphicon-comment"></span></a></div>
									</div>';
								if(count($comments) > 0){
									foreach ($comments as $comment) {
										if($comment["user_nname"] == '' || $comment["user_nname"] == NULL){
											$cusername = $comment["user_fname"].' '.$comment["user_lname"];
										}else{
											$cusername = $comment["user_nname"];	
										}
										$cpic = 'images/'.$comment["picture_path"];
										echo'<div style="background-color: #E4F0F1; padding:5px; border-radius: 3px; border:1px solid grey;">
  										<img src="'.$cpic.'" class="profile float-to-left" style="height:35px; ">
  										<a class="Username float-to-left" href="profile.php?username='.$cusername.'">'.$cusername.'</a>
  										<form method="post" class="float-to-left pull-right">';
  										if($_SESSION["user_id"] == $comment['user_id']){
  										echo'<a href="" onclick="remove_comment('.$comment['comment_id'].');"><span class="glyphicon glyphicon-remove-circle pull-right"></span></a>';}
										echo'</form><br><br>
  										<div>
  										<span class="post-timestamp">'.$comment["comment_timestamp"].'</span>
    									<p>'.$comment['comment_text'].'</p>
  									</div>
								</div>';
									}
								}
									
								echo'</form>
								</div>
								</li>';}
								else if($result2 == 1)
								{
									echo '<hr>
									<form class="form">
									<p><a href="" class="comment-like like" id="'. $post['post_id'].'" onclick="like_remove('. $post['post_id'].');"><span class="glyphicon glyphicon-thumbs-down">  Unlike</span></a><br></br><span id="post_'. $post['post_id'].'_likes"> '.$post["number_likes"].'</span> Liked This.</p>
									<hr>';
									$querylikers = ("SELECT u.user_fname,u.user_lname,u.user_nname,p.picture_path from likes
									Inner join users as u ON u.user_id=likes.user_id 
									Inner join pictures as p on u.user_profile_picture = p.picture_id
									where post_id='".$post['post_id']."' 
									ORDER BY likes.like_timestamp");
                        			$resultl = mysqli_query($link , $querylikers);
                        			$resultsl = mysqli_num_rows($resultl);
									while($rowli=mysqli_fetch_array($resultl))
									{
										$lUpic='images/'.$rowli['picture_path'];
							
								echo '<li>
										
					  					<div>
					      					<img src="'.$lUpic.'" class="profile" style="height:20px; ">';
										if($rowli['user_nname'] == '' || $rowli['user_nname'] == NULL){
											$likername=$rowli['user_fname'].' '.$rowli['user_lname'];
										}else{
											$likername=$rowli['user_nname'];
										}

 										echo '
						   
						   				<span>  '.$likername.'</span> ';
						   			}
						   			  echo'
					  				<span> Liked Your Post. </span></div><hr>
									<div class="input-group">
									<input type="text" name="comment" class="form-control"  id="comment_'.$post['post_id'].'" placeholder = "Write a comment...">
									<div class="input-group-addon"><a href="" onclick="add_comment('.$post['post_id'].');"><span class="glyphicon glyphicon-comment"></span></a></div>
									</div>';
									if(count($comments) > 0){
										foreach ($comments as $comment) {
											if($comment["user_nname"] == '' || $comment["user_nname"] == NULL){
												$cusername = $comment["user_fname"].' '.$comment["user_lname"];
											}
											else{
												$cusername = $comment["user_nname"];	
											}
											$cpic = 'images/'.$comment["picture_path"];
											echo'<div style="background-color: #E4F0F1; padding:5px; border-radius: 3px; border:1px solid grey;">
  											<img src="'.$cpic.'" class="profile float-to-left" style="height:35px; ">
  											<a class="Username float-to-left" href="profile.php?username='.$cusername.'">'.$cusername.'</a>
  											<form method="post" class="float-to-left pull-right">';
  											if($_SESSION["user_id"] == $comment['user_id']){
  											echo'<a href="" onclick="remove_comment('.$comment['comment_id'].');"><span class="glyphicon glyphicon-remove-circle pull-right"></span></a>';}
											echo'</form><br><br>
  											<div>
  											<span class="post-timestamp">'.$comment["comment_timestamp"].'</span>
    										<p>'.$comment['comment_text'].'</p>
  											</div>
											</div>';
										}	
									}

									echo'</li></form>
									</div>
									</li>';
								}

							}
						}
						

				
				?>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">

function like_add(post_id){
	$.post('like_add.php',{post_id:post_id});}

function like_remove(post_id){
	$.post('like_remove.php',{post_id:post_id});}

function add_comment(post_id){
	$comment = $('#comment_'+post_id).val();
	var info=[];
	info[0] = post_id;
	info[1] = $comment;
	$.post('add_comment.php',{info:info});}

function remove_comment(comment_id){
	$.post('remove_comment.php',{comment_id:comment_id});}

</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/js/bootstrap.min.js"></script>
	<script src="jquery.bootstrap-growl.js"></script>
	<script src="jquery.bootstrap-growl.min.js"></script>

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
	
	if(notif2>notif1)
	{
		//alert("NEW");
		


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
