<?php
include 'connection.php';


//echo $_SESSION['user_id'];

$query = ("SELECT * FROM `notification` WHERE Ouserid='".$_SESSION['user_id']."'

ORDER BY notifTime DESC");

$result = mysqli_query($link , $query);

//$row = mysqli_fetch_array($result);

/*
$query2=mysql_query("
SELECT Count(*) FROM `notification` WHERE Ouserid='".$_SESSION['user_id']."'
and notifTime BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 9800 SECOND)) AND timestamp(NOW())
ORDER BY notifTime DESC");

$result2 = mysqli_query($link , $query2);
$row2 = mysqli_fetch_array($result2);

*/


$results = mysqli_num_rows($result);

//echo $results;

		if($results > 0){
			
			$i=0;
			//$OUID=$row['Ouserid'];
				//echo $OUID;
				
				//$query3=("SELECT CONCAT(Ucase((user_fname)), UCase((user_lname))) as dataa,p.picture_path from users Inner Join pictures as p ON users.user_profile_picture=p.picture_id  where User_id= $OUID");
				//$result3 = mysqli_query($link , $query3);
                //$row3 = mysqli_fetch_array($result3);
				//$OUname=$row3['dataa'];
			//echo$results;
			while($row=mysqli_fetch_array($result))
			{
				
				
				$i=$i+1;
				//echo "INNNN".$i;
				$FUID=$row['Fuserid'];
				$query3=("SELECT CONCAT(Ucase((user_fname)), UCase((user_lname))) as dataa ,
				p.picture_path from users Inner Join pictures as p ON users.user_profile_picture=p.picture_id where User_id= $FUID");
				$result3 = mysqli_query($link , $query3);
                $row3 = mysqli_fetch_array($result3);
				$FUname=$row3['dataa'];
				//echo $FUname."HHEHEHHEHEH";
				$FUpic='images/'.$row3['picture_path'];
				
				$type=$row['type'];
				$POST=$row['Postid'];
				
				if($type=='0')
				{
					echo '
					<li>
					  <div>
					       <img src="'.$FUpic.'" class="profile">
						   <a href="" >'.$FUname.'</a>
						   <span>  Liked your </span> 
						   <a href="ShowPOST.php?varname='.$POST.'<?php echo $POST ?>" >POST</a>
					  </div>   ';
					  
					  
					//echo $FUname." Liked your Post \n"."\n";
					
				}
				else{
					echo '
					<li>
					  <div>
					       <img src="'.$FUpic.'" class="profile">
						   <a href="" >'.$FUname.'</a>
						   <span>  Commented ON your </span> 
						   <a href="ShowPOST.php?varname='.$POST.'<?php echo $POST ?>" >POST</a>			   
					  </div>   ';
					//echo $FUname." commented on your Post\n"."\n";
				}
				
			}
			//echo $i;
			
			
		}
		else{
			echo"NO NOTIFICATION YET !";
		}










?>