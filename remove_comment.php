<?php
include("connection.php"); 
$user_id =$_SESSION['user_id'];
if (isset($_POST['comment_id'])) {
	$commentid = (int)$_POST['comment_id'];
		$query = "DELETE FROM `notification` WHERE `commentid` = '".$commentid."' AND `type` = b'1'";
		mysqli_query($link,$query);
		$query1 = "DELETE FROM `comments` WHERE `comment_id` = '".$commentid."' AND `user_id` = '".$user_id."'";
		mysqli_query($link,$query1);
}
?>