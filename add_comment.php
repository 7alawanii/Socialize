<?php
include("connection.php"); 
$user_id =$_SESSION['user_id'];
//print_r($_POST);
if (isset($_POST['info'])) {
	$info = implode(',',$_POST['info']);
	$temp = explode(',',$info);
	$post_id = (int)$temp[0];
	$comment = (string)$temp[1];
	$query1 = "SELECT Count(`post_id`) FROM posts WHERE post_id = '".$post_id."'";
	$result1 = mysqli_query($link,$query1);
	$result1 = mysqli_fetch_array($result1);
	$result1 = $result1[0];
	if($result1 == 1) {
		$queryf = "SELECT user_id FROM posts WHERE post_id = '".$post_id."'";
		$resultf = mysqli_query($link,$queryf);
		$resultf = mysqli_fetch_array($resultf);
		$resultf = $resultf[0];
		$query2 = "INSERT INTO `comments` (`post_id` , `user_id` , `comment_text`) VALUES ('".$post_id."','".$user_id."','".$comment."')";
		mysqli_query($link,$query2);
		$commentid = mysqli_insert_id($link);		
		$query3 = "INSERT INTO `notification` (`Ouserid`, `Fuserid`, `Postid`, `type`,`commentid`) VALUES ('".$resultf."','".$user_id."','".$post_id."', b'1','".$commentid."')";
		mysqli_query($link,$query3);
	}
}
?>