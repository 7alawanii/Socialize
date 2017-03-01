<?php

	include("connection.php");

	if(isset($_POST['Accept'])){
$user_id=$_POST['user_id'];
$friend_id=$_POST['friend_id'];
		
$query = "update friendships set friend_type=1 
where user_id=".$user_id." and friend_id=".$friend_id.";";

			$result = mysqli_query($link, $query);

			if($result){
				header("Location: requests.php");
			}
		
		}
		elseif(	isset($_POST['Decline'])){
$user_id=$_POST['user_id'];
$friend_id=$_POST['friend_id'];
		
$query = "delete from  friendships
where user_id=".$user_id." and friend_id=".$friend_id.";";

			$result = mysqli_query($link, $query);
			echo $_POST['Decline'];
			if($result && $_POST['Decline'] != 'Delete'){
				header("Location: requests.php");
			}elseif($result && $_POST['Decline'] == 'Delete'){
				header("Location: friends.php");
			}
		}elseif(	isset($_POST['Decline_search'])){
$user_id=$_POST['user_id'];
$friend_id=$_POST['friend_id'];
		
$query = "delete from  friendships
where user_id=".$user_id." and friend_id=".$friend_id.";";

			$result = mysqli_query($link, $query);
			echo $_POST['Decline'];
			if($result && $_POST['Decline_search'] != 'Delete'){
				header("Location: requests.php");
			}elseif($result && $_POST['Decline_search'] == 'Delete'){
				header("Location: search.php");
			}
		}elseif(	isset($_POST['Decline_profile'])){
$user_id=$_POST['user_id'];
$friend_id=$_POST['friend_id'];
$username=$_POST['username'];
		echo $username;
$query = "delete from  friendships
where user_id=".$user_id." and friend_id=".$friend_id." or user_id=".$friend_id." and friend_id=".$user_id.";";

			$result = mysqli_query($link, $query);
			echo $_POST['Decline_profile'];
			if($result && $_POST['Decline_profile'] != 'Delete'){
				header("Location: requests.php");
			}elseif($result && $_POST['Decline_profile'] == 'Delete'){
				header("Location: profile.php?username=".$username);
			}
		}

?>