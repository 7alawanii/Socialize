<?php

	include("connection.php");

	if(isset($_POST['signup'])){


		if($_POST['phone']==""){
			echo "no phone";
			if($_POST['gender'] == 'M'){
				echo "m";
				$date = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
				//echo $date;


				$query = "INSERT INTO `users` (user_email, user_password , user_fname, user_lname, user_gender,user_birthdate , user_profile_picture)
				VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".md5($_POST['password'])."' ,'".mysqli_real_escape_string($link, $_POST['fname'])."','".mysqli_real_escape_string($link, $_POST['lname'])."', '0' ,'".$date."' , '0')";
				$result = mysqli_query($link, $query);

			if($result){
				$_SESSION['user_id'] = mysqli_insert_id($link);
				header("Location: home.php");
			}
		}
		else{
			echo "f";
			$date = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
			//echo $date;

			$query = "INSERT INTO `users` (user_email, user_password , user_fname, user_lname, user_gender,user_birthdate , user_profile_picture)
				VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".md5($_POST['password'])."' ,'".mysqli_real_escape_string($link, $_POST['fname'])."','".mysqli_real_escape_string($link, $_POST['lname'])."', '1' ,'".$date."', '1')";
			$result = mysqli_query($link, $query);

			if($result){
				$_SESSION['user_id'] = mysqli_insert_id($link);
				header("Location: home.php");
			}
		
		}
	

	}
	else{
		echo "phone";
		if($_POST['gender'] == 'M'){
			echo "mm";
			$date = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];

			//echo $date;
			$query = "INSERT INTO `users` (user_email , user_password, user_fname, user_lname, user_gender , user_birthdate , user_profile_picture)
			VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".md5($_POST['password'])."' ,'".mysqli_real_escape_string($link, $_POST['fname'])."','".mysqli_real_escape_string($link, $_POST['lname'])."', '0' ,'".$date."', '0')";
			$result = mysqli_query($link, $query);
			$inserted_user = mysqli_insert_id($link);
			$query = "INSERT INTO phones (user_id,phone_number) VALUES ('".$inserted_user."', '".mysqli_real_escape_string($link, $_POST['phone'])."')";
			$result1 = mysqli_query($link, $query);
			if($result && $result1){
				$_SESSION['user_id'] = $inserted_user;
				header("Location: home.php");
			}
		
		}
		else{
			echo "ff";
			$date =$_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];

			$query = "INSERT INTO `users` (user_email , user_password, user_fname, user_lname, user_gender , user_birthdate , user_profile_picture)
			VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".md5($_POST['password'])."' ,'".mysqli_real_escape_string($link, $_POST['fname'])."','".mysqli_real_escape_string($link, $_POST['lname'])."', '1' ,'".$date."', '1')";
			$result = mysqli_query($link, $query);
			$inserted_user = mysqli_insert_id($link);
			$query = "INSERT INTO phones (user_id,phone_number) VALUES ('".$inserted_user."', '".mysqli_real_escape_string($link, $_POST['phone'])."')";
			$result1 = mysqli_query($link, $query);
			if($result && $result1){
				$_SESSION['user_id'] = $inserted_user;
				header("Location: home.php");
			}
		}
}
		
			

			
			//print_r($_SESSION['user_id']);
	}

?>