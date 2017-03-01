<?php





	include 'connection.php';
	global $notifCount1;
	global $notifCount2;
	
	
	$query = ("SELECT count(*) as c FROM `notification` WHERE Ouserid='".$_SESSION['user_id']."'");

    $result = mysqli_query($link, $query);


    $results = mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);
	$notifCount2 = $row['c'];

	echo $notifCount2;
	/* if($notifCount2 > $notifCount1)
	{
		
		echo "YOU HAVE GOT A NOTIFICATION .".$notifCount1." CHECK NOTIFICATION!".$notifCount2;
		$notifCount1=$notifCount2;
		
	}
	
	else
	{
		echo "ETWKES :D !".$notifCount1." CHECK NOTIFICATION!".$notifCount2; 
		
	} */
	
	//mysqli_close($link);
	
	
	



?>