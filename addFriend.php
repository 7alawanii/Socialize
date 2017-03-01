<?php

	include("connection.php");

	if(isset($_POST['AddFriend'])){
$user_id=$_POST['user_id'];
$friend_id=$_POST['friend_id'];
$user_name=$_POST['username'];
echo $user_id.' ';
echo $friend_id.' ';
echo $user_name.' ';
$query = "INSERT INTO `friendships`(`user_id`, `friend_id`, `friend_type`) VALUES ('".$friend_id."','".$user_id."','0')";
			$result = mysqli_query($link, $query);
		header("Location: profile.php?username=".$user_name);
	}

	if(isset($_POST['AddFriend1'])){
$user_id=$_POST['user_id'];
$friend_id=$_POST['friend_id'];
$user_name=$_POST['username'];
echo $user_id.' ';
echo $friend_id.' ';
echo $user_name.' ';
$query = "INSERT INTO `friendships`(`user_id`, `friend_id`, `friend_type`) VALUES ('".$friend_id."','".$user_id."','0')";
			$result = mysqli_query($link, $query);
		header("Location: search.php");
	}
?>