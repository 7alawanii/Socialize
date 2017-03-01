<?php
include("connection.php"); 
$user_id =$_SESSION['user_id'];
if (isset($_POST['post_id'])) {
	$post_id = (int)$_POST['post_id'];
	$query1 = "SELECT Count(`post_id`) FROM posts WHERE post_id = '".$post_id."'";
	$result1 = mysqli_query($link,$query1);
	$result1 = mysqli_fetch_array($result1);
	$result1 = $result1[0];
	if($result1 == 1) {
		$queryf = "SELECT user_id FROM posts WHERE post_id = '".$post_id."'";
		$resultf = mysqli_query($link,$queryf);
		$resultf = mysqli_fetch_array($resultf);
		$resultf = $resultf[0];
		$query2 = "SELECT Count(`post_id`) FROM likes WHERE user_id ='".$user_id."' AND post_id = '".$post_id."'";
		$result2 = mysqli_query($link,$query2);
		$result2 = mysqli_fetch_array($result2);
		$result2 = $result2[0];
		if($result2 == 1){
			$query3 = "UPDATE posts SET number_likes = number_likes - 1 WHERE post_id = '".$post_id."'";
			mysqli_query($link,$query3);
			$query4 = "DELETE FROM `likes` WHERE `post_id` = '".$post_id."' AND `user_id` = '".$user_id."'";
			mysqli_query($link,$query4);
			$query5 = "DELETE FROM `notification` WHERE `Ouserid`='".$user_id."' AND `Fuserid` = '".$resultf."' AND `Postid` ='".$post_id."' AND `type` = b'0'";
			mysqli_query($link,$query5);
		}
	}
}
?>