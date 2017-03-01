<?php

if(isset($_POST['login'])){
include 'connection.php';

$loginpassword=$_POST['loginpassword'];
$hashedpassword = md5($loginpassword);
$loginemail=$_POST['loginemail'];

		$sql = "SELECT `user_id` FROM `users` WHERE user_email = "."'$loginemail'". "AND user_password = "."'$hashedpassword'";
		$result = $link->query($sql);
		$results = mysqli_fetch_array($result);
	if ($result->num_rows<=0)
     {
     	$message = "Incorrect username and password .\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
     }
	 else
	 {	
	 	$_SESSION['user_id'] = $results['user_id'];
		header("Location: home.php");	 
	 }

	 }

?>