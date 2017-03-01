<?php
	
	include 'connection.php';

	
	global $notifCount1;
     $query = ("SELECT count(*)as c FROM `notification` WHERE Ouserid='".$_SESSION['user_id']."'
    and notifTime BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 888800 DAY)) AND timestamp(NOW())
    ORDER BY notifTime DESC");

    $result = mysqli_query($link, $query);


    $results = mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);
	//$notifCount1=3;
	
	$notifCount1=$row['c'];
	//print_r($row);
	
	echo $notifCount1;
	
?>