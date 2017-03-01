<?php 
include 'connection.php';
if (isset($_POST['posttext'])) {

		
	$timestamp = date("Y-m-d H:i:s");
	$post = $_POST['posttext'];
	$query = "INSERT INTO `posts`(`user_id`, `post_timestamp`, `post_text`) VALUES ('".$_SESSION['user_id']."','".$timestamp."','".$post."')";
	mysqli_query($link,$query);

	echo "OK";
	

}
else{
	echo "Nothing to post";
}

?>