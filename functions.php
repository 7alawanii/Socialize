<?php



function get_loggedin_username(){
	include 'connection.php';
	$query = "SELECT p.picture_path, u.user_fname , u.user_lname, u.user_nname FROM pictures as p inner join users as u on u.user_profile_picture = p.picture_id WHERE u.user_id = '".$_SESSION['user_id']."'";
	$result = mysqli_query($link , $query);
	$row = mysqli_fetch_array($result);
	$loggedin_user[0] = 'images/'.$row[0];
	$loggedin_user[1] = $row[1].' '.$row[2];
	$loggedin_user[2] = $row[0];
	$loggedin_user[3] = $row[3];
	
	return $loggedin_user;
}

function posting(){
	
	include 'connection.php';
	$posttext = "";
	$posttext = $_POST['posttext'];
	$privacy = $_POST['privacy'];
	if($privacy == 'public' || $privacy == ""){
		

		if ($_FILES['postimage']['name'] != "") {
			$path = $_FILES['postimage']['name'];
			$path = check_picture_name($path,'postimage');
			$target = 'images/'.basename($_FILES['postimage']['name']);
	
			if($posttext != ""){				
				$query = "INSERT INTO pictures (picture_path) VALUES ('".$path."')";
				mysqli_query($link,$query);
				$timestamp = date("Y-m-d H:i:s");
				$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`, `post_text`,`post_picture_id` , `is_image`) VALUES ('".$_SESSION['user_id']."','".$timestamp."','".$posttext."' ,'".mysqli_insert_id($link)."','1')";
				mysqli_query($link,$query);
			}else{
				$query = "INSERT INTO pictures (picture_path) VALUES ('".$path."')";
				//mysqli_query($link,$query);
				$timestamp = date("Y-m-d H:i:s");
				$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`,`post_picture_id` , `is_image`, `is_text`) VALUES ('".$_SESSION['user_id']."','".$timestamp."' ,'".mysqli_insert_id($link)."','1' ,'0')";
				mysqli_query($link,$query);
			}
			move_uploaded_file($_FILES['postimage']['tmp_name'], $target);
		
		}else{
			$timestamp = date("Y-m-d H:i:s");
			echo "here111";
			if ($posttext != ""){
				echo "here5";
				$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`, `post_text`) VALUES ('".$_SESSION['user_id']."','".$timestamp."','".$posttext."' )";
				mysqli_query($link,$query);
			}else{
			}
		}
	}else{
		if ($_FILES['postimage']['name'] != "") {
			$path = $_FILES['profilepic']['name'];
			$path = check_picture_name($path,'profilepic');
			$target = 'images/'.basename($_FILES['postimage']['name']);	
			if($posttext != ""){
				$query = "INSERT INTO pictures (picture_path) VALUES ('".$path."')";
				mysqli_query($link,$query);
				$timestamp = date("Y-m-d H:i:s");
				$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`, `post_text`,`post_picture_id` , `is_image`, `post_privacy`) VALUES ('".$_SESSION['user_id']."','".$timestamp."','".$posttext."' ,'".mysqli_insert_id($link)."','1', '0')";
				mysqli_query($link,$query);
			}else{
				$query = "INSERT INTO pictures (picture_path) VALUES ('".$path."')";
				//mysqli_query($link,$query);
				$timestamp = date("Y-m-d H:i:s");
				$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`,`post_picture_id` , `is_image`, `is_text` , `post_privacy`) VALUES ('".$_SESSION['user_id']."','".$timestamp."' ,'".mysqli_insert_id($link)."','1' ,'0' , '0')";
				mysqli_query($link,$query);
			}
			move_uploaded_file($_FILES['postimage']['tmp_name'], $target);
		
		}else{
			$timestamp = date("Y-m-d H:i:s");
			if ($posttext != ""){
				$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`, `post_text` , `post_privacy`) VALUES ('".$_SESSION['user_id']."','".$timestamp."','".$posttext."' , '0' )";
				mysqli_query($link,$query);
			}else{
			}
		}
	}
	
}

function check_user_profile_picture(){
	include 'connection.php';
	$query = "SELECT user_profile_picture from users WHERE user_id = '".$_SESSION['user_id']."'";
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_array($result);
	if ($row['user_profile_picture'] == NULL) {
		$query = "UPDATE users SET user_profile_picture = user_gender where user_id = '".$_SESSION['user_id']."'";
		mysqli_query($link,$query);
	}
}

function check_picture_name($path, $arg){
	include 'connection.php';
	$counter = 0;
	$query = "SELECT * from pictures where picture_path = '".$path."'";
	$result = mysqli_query($link,$query);
	while(  mysqli_num_rows($result) > 0){
		$counter = 1;
		if ($counter != 0) {
			$query = "SELECT * from pictures where picture_path = '".$path."'";
			$result = mysqli_query($link,$query);
		}
		$random = rand(10,1000);
		$temp = explode(".", $path);
		$ext =  pathinfo($path, PATHINFO_EXTENSION);
		$_FILES[$arg]['name'] = $temp[0].$random.'.'.$ext;
		$path = $_FILES[$arg]['name'];
		
	}
	return $path;
}

function upload_profile_picture(){
	include 'connection.php';
	if ($_FILES['profilepic']['name'] != "") {
				$loggedin_user = get_loggedin_username();
				//$counter = $counter + 1;
				$path = $_FILES['profilepic']['name'];
				$path = check_picture_name($path,'profilepic');
				$target = 'images/'.basename($_FILES['profilepic']['name']);
				
				$query = "INSERT INTO pictures (picture_path) VALUES ('".$path."')";
				mysqli_query($link,$query);
				$pictid = mysqli_insert_id($link);
				move_uploaded_file($_FILES['profilepic']['tmp_name'], $target);
				
				$query = "UPDATE users SET user_profile_picture='".mysqli_insert_id($link)."' where user_id = '".$_SESSION['user_id']."'";
				mysqli_query($link,$query);
				if ($loggedin_user[2] != 'defaultmale.png' || $loggedin_user[2] != 'defaultfemale.png') {
					$query = "DELETE from pictures where picture_path = '".$loggedin_user[2]."'";
					mysqli_query($link,$query);
				}
				
				$post_text = $loggedin_user[1] .' has changed his/her profile picture.';
				$query = "SELECT post_id from posts where post_text = '".$post_text."' and post_privacy = 0";
				$result = mysqli_query($link,$query);
				$num = mysqli_num_rows($result);
				if ($num > 0) {
					$timestamp = date("Y-m-d H:i:s");
					$query = "UPDATE posts SET post_picture_id = '".$pictid."' , post_timestamp = '".$timestamp."'  where post_text = '".$post_text."' and user_id = '".$_SESSION["user_id"]."'";
					mysqli_query($link,$query);
				}else{
					$query = "INSERT INTO posts (user_id,post_privacy,is_image , is_text , post_text , post_picture_id) VALUES ('".$_SESSION["user_id"]."' , '0','1','1','".$post_text."' , '".$pictid."')";
					mysqli_query($link,$query);
				}
			}
}



function browse_friends(){
	include 'connection.php';
	//$friends = array();
	//$query = "SELECT u.user_fname , u.user_lname , u.user_nname,pi.picture_path , f.user_id , f.friend_id from users as u inner join friendships as f on u.user_id = f.friend_id inner join pictures as pi on u.user_profile_picture = pi.picture_id WHERE f.user_id = '".$_SESSION['user_id']."' and f.friend_type = 1";
	$myid = $_SESSION['user_id'];
	$queryf = "SELECT friend_id,user_id FROM `friendships` 
            		WHERE friend_type = 1 
            		AND (user_id = '".$_SESSION['user_id']."' OR friend_id = '".$_SESSION['user_id']."')";
            		$resultf = mysqli_query($link, $queryf);
					$friends = array();
					$counter = 0;
					while($rowf = mysqli_fetch_array($resultf)){
    					if($rowf[0] == $myid OR $rowf[1] != $myid){
        					$friends[$counter] = $rowf[1];
    					}
    					else if($rowf[1] == $myid){
        					$friends[$counter] = $rowf[0];
    					}
    					$counter = $counter + 1;
					}
					$friends_array = array();
					if (!empty($friends)) {
						# code...
					
	$query = "SELECT DISTINCT u.user_fname , u.user_lname , u.user_nname,pi.picture_path , u.user_id , f.friend_id from users as u inner join friendships as f on u.user_id = f.friend_id inner join pictures as pi on u.user_profile_picture = pi.picture_id WHERE u.user_id IN (" . implode(',', $friends) . ")";

	
	$result = mysqli_query($link , $query);
	while($row = mysqli_fetch_array($result)){
		$friends_array[] = array(
			'user_id' => $row['user_id'],
			'friend_id' => $row['friend_id'],
			'user_fname' => $row['user_fname'],
			'user_lname' => $row['user_lname'],
			'user_nname' => $row['user_nname'],
			'picture_path' => $row['picture_path']
			);
	}
	}
	return $friends_array;
}


function show_posts(){
	include 'connection.php';
	$myid = $_SESSION['user_id'];
					$queryf = "SELECT friend_id,user_id FROM `friendships` 
            		WHERE friend_type = 1 
            		AND (user_id = '".$myid."' OR friend_id = '".$myid."')"; 
					$resultf = mysqli_query($link, $queryf);
					$friends = array();
					$counter = 0;
					while($rowf = mysqli_fetch_array($resultf)){
    					if($rowf[0] == $myid OR $rowf[1] != $myid){
        					$friends[$counter] = $rowf[1];
    					}
    					else if($rowf[1] == $myid){
        					$friends[$counter] = $rowf[0];
    					}
    					$counter = $counter + 1;
					}

					if (!empty($friends)) {
						$query = "SELECT * from posts as p left join pictures as pi on pi.picture_id = p.post_picture_id where ( p.user_id IN(" . implode(',', $friends) . ") and p.post_privacy = 0) OR p.post_privacy = 1 OR (p.post_privacy = 0 AND p.user_id = '".$myid."') ORDER BY p.post_timestamp DESC";
					}else{
						$query = "SELECT * from posts as p left join pictures as pi on pi.picture_id = p.post_picture_id where p.post_privacy = 1 OR (p.post_privacy = 0 AND p.user_id = '".$myid."') ORDER BY p.post_timestamp DESC";
					}
					$posts = array();
					$results = mysqli_query($link,$query);

						while ( $row = mysqli_fetch_array($results) ) {
							$posts[] = array(
									'post_id' => $row['post_id'],
									'user_id' => $row['user_id'],
									'post_privacy' => $row['post_privacy'],
									'post_timestamp' => $row['post_timestamp'],
									'number_likes' => $row['number_likes'],
									'is_image' => $row['is_image'],
									'is_text' => $row['is_text'],
									'post_text' => $row['post_text'],
									'post_picture_id' => $row['post_picture_id'],
									'picture_id' => $row['picture_id'],
									'picture_path' => $row['picture_path']
								);
						}

	return $posts;
}


function show_comments($post_id){
	include 'connection.php';
	$comments = array();
	$query = "SELECT * FROM `comments` as c inner join users as u on u.user_id = c.user_id  
	inner join pictures as pi on pi.picture_id = u.user_profile_picture WHERE post_id = '".$post_id."' ORDER BY c.comment_timestamp DESC";
	$results = mysqli_query($link,$query);
						while ( $row = mysqli_fetch_array($results) ) {
							$comments[] = array(
									'comment_id' => $row['comment_id'],
									'user_id' => $row['user_id'],
									'user_fname' => $row['user_fname'],
									'user_lname' => $row['user_lname'],
									'user_nname' => $row['user_nname'],
									'comment_timestamp' => $row['comment_timestamp'],
									'comment_text' => $row['comment_text'],
									'picture_id' => $row['user_profile_picture'],
									'picture_path' => $row['picture_path']
								);
						}

	return $comments;
}