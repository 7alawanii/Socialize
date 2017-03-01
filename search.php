<?php 
include 'header.php';
include("connection.php"); 
$show = True;
$search = $_POST['search'];
if($search == ''){
    $show = False;
}
if ($show == True){
#echo $search;
$myid = $_SESSION['user_id'];

#$search = 'ahmed';
#$myid = 6;
$i = 0;
$j = 0;
$queryf = "SELECT friend_id,user_id FROM `friendships` 
            WHERE friend_type = 1 
            AND (user_id = '".$myid."' OR friend_id = '".$myid."')"; 
$resultf = mysqli_query($link, $queryf);
$num_resf = mysqli_num_rows($resultf);
$friends = array();
$friends[0]='';
$counter = 0;
while($rowf = mysqli_fetch_array($resultf)){
    if($rowf[0] == $myid OR $rowf[1] != $myid){
        $friends[$counter] = $rowf[1];
    }
    else if($rowf[1] == $myid){
        $friends[$counter] = $rowf[0];
    }
    $counter = $counter + 1;
}
$queryu = "SELECT DISTINCT u.user_id,u.user_fname, u.user_lname, pi.picture_path, u.user_nname FROM `users` as u inner join pictures as pi on pi.picture_id = u.user_profile_picture
            WHERE (u.user_fname LIKE '%".$search."%' 
            OR u.user_lname LIKE '%".$search."%'
            OR u.user_email = '".$search."'
            OR u.user_hometown LIKE '%".$search."%')
            AND u.user_id != '".$myid."'"; 
$resultu = mysqli_query($link, $queryu);
$num_resu = mysqli_num_rows($resultu);
$queryp = "SELECT DISTINCT * FROM posts as p left join pictures as pi on pi.picture_id = p.post_picture_id
            WHERE post_text LIKE '%".$search."%' AND user_id = '".$myid."'
            ORDER BY p.post_timestamp DESC";
$resultp = mysqli_query($link, $queryp);
$num_resp = mysqli_num_rows($resultp);
while ( $rowp = mysqli_fetch_array($resultp) ) {
        $posts[] = array(
            'post_id' => $rowp['post_id'],
            'user_id' => $rowp['user_id'],
            'post_privacy' => $rowp['post_privacy'],
            'post_timestamp' => $rowp['post_timestamp'],
            'number_likes' => $rowp['number_likes'],
            'is_image' => $rowp['is_image'],
            'is_text' => $rowp['is_text'],
            'post_text' => $rowp['post_text'],
            'post_picture_id' => $rowp['post_picture_id'],
            'picture_id' => $rowp['picture_id'],
            'picture_path' => $rowp['picture_path']
            );
    }                        
}
?>
 <div class="container">
 <div class="row">
 	<div class="col-md-3" style="position : fixed;">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="home.php">Home</a>
            </li>
            <li class="list-group-item">
                <a href="profile.php?username=<?php echo $username;  ?>">Profile</a>
            </li>
            <li class="list-group-item">
                <a href="editprofile.php">Edit Profile</a>
            </li>
            <li class="list-group-item">
                <a href="friends.php">Friends<span class="badge pull-right"><?php echo $rowf['friends_num'];  ?></span></a>
            </li>
            <li class="list-group-item">
                <a href="Requests.php">Friend Requests<span class="badge pull-right"><?php echo $row['requests'];  ?></span></a>
            </li>
            <li class="list-group-item">
                <a href="">Messages</a>
            </li>
            <li class="list-group-item">
                <a href="">Photos of you</a>
            </li>
        </ul>
        </div>
        <div class="col-md-6 col-md-offset-3">
        	<ul>
                <?php
                $friend_id = 0;
                if ($show == True && ($num_resp > 0 || $num_resu > 0 || $num_resp > 0)){
                    if($friends[0] == ''){
                        while ($rowu = mysqli_fetch_array($resultu)) {
                            $friend_id = $rowu[0];
                            $profile_pic = 'images/'.$rowu[3];
                            $nickname = $rowu[4];
                            if ($nickname == '' || $nickname == NULL) {
                                $username = $rowu[1].' '.$rowu[2];
                            }else{
                                $username = $nickname;
                            }
                    $userid = $rowu[0];

                    //$username = $rowu[1].' '.$rowu[2];
                     echo'<li>
                    <!--  if u are not already friends --> 
                    <div>
                        <img src="'.$profile_pic.'" class="request" id="add">
                        <a class="Username" href="profile.php?username='.$username.'">';  echo $username; 
                        
                        echo'</a>
                        
                            <button class="btn btn-margin pull-right" id="add" style="margin-top: 50px;">
                                Add Friend +
                            </button>
                    
                    </div>
                </li>';}
                    }
                    else{
                while ($rowu = mysqli_fetch_array($resultu)) {
                    $userid = $rowu[0];
                    $friend_id = $rowu[0];
                    $profile_pic = 'images/'.$rowu[3];
                    $nickname = $rowu[4];
                            if ($nickname == '' || $nickname == NULL) {
                                $username = $rowu[1].' '.$rowu[2];
                            }else{
                                $username = $nickname;
                            }
                    $flag = 0;
                    while($i < $counter AND $flag == 0){
                          if($userid == $friends[$i]){  
        		          $flag = 1;
                echo'<li>
        			<!--  if u are already friends --> 
        			<div>
        				<img src="'.$profile_pic.'" class="request" id="add">
						<a class="Username" href="profile.php?username='.$username.'">'; echo $username;
                       
                        echo'</a>
						
							<form method="post" action="friendrequests.php">
                                <input type="submit" class="btn pull-right" style="position : relative; top: -70px;" name="Decline_search" value="Delete"/>
                                <input type="hidden" name="user_id" value="'. $_SESSION["user_id"].'"></input>
                                <input type="hidden" name="friend_id" value="'.$friend_id.'"></input> 
                            </form>
					
        			</div>
        		</li>';}
            $i = $i + 1;
            }    
                while($j < $counter AND $flag == 0){
                          if($userid != $friends[$j]){  
                    $flag = 1;
                echo'<li>
                    <!--  if u are not already friends --> 
                    <div>
                        <img src="'.$profile_pic.'" class="request" id="add">
                        <a class="Username" href="profile.php?username='.$username.'">';  echo $username; 
                        echo $friend_id;
                        echo'</a>
                        


                            <form method="post" action="addFriend.php">
                                <button class="btn pull-right" id="add" style="position : relative; top: -70px;" name="AddFriend1">
                                    Add Friend +
                                </button>
                                <input type="hidden" value="'. $_SESSION["user_id"] .'" name="user_id">
                                <input type="hidden" value="'. $friend_id .'" name="friend_id">
                                <input type="hidden" value="'. $username .'" name="username">
                            </form>

                    
                    </div>
                </li>';}
                $j = $j + 1;    
            }
        }
    }

            //if (count($posts) == 0) {
                          //  echo '<div class="alert alert-warning" role="alert"><strong>No posts to show !!</strong></div>';
                        //}else{
                        if($num_resp > 0){
                            foreach ($posts as $post) {
                            $query = "SELECT user_fname , user_lname , picture_path, user_nname FROM users as u inner join posts as po on po.user_id = u.user_id inner join pictures as pi on pi.picture_id = u.user_profile_picture WHERE po.user_id = '".$post["user_id"]."'";
                            $result = mysqli_query($link,$query);
                            $rows = mysqli_fetch_array($result);
                            $profile_pic = 'images/'.$rows[2];
                            $nickname = $rows[3];
                            if ($nickname == '' || $nickname == NULL) {
                                $username = $rows[0].' '.$rows[1];
                            }else{
                                $username = $nickname;
                            }
                            $postpic = "";
                            $postpic = 'images/'.$post["picture_path"];
                            $postid = $post["post_id"];
                            echo'
                            <li>
                                <div>
                                    <img src="'.$profile_pic.'" class="profile">
                                    <a class="Username" href=profile.php?username='.$username.'>'.$username.'</a>
                                    <div class="timestamp">
                                    <span class="post-timestamp">'.$post["post_timestamp"].'</span>
                                </div>';
                                if ($post['is_image'] == '1') {
                            
                                    echo '<div>
                                    <img src="'.$postpic.'" style="height : 380px; width: 400px;"/>
                                    </div><br>';
                                }
                                echo '<div><p>'.$post["post_text"].'</p></div>';

                                echo '<hr>
                                <form class="form">
                                    <p><a href="" class="comment-like like" id="'. $post['post_id'].'" onclick="like_add('. $post['post_id'].');"><span class="glyphicon glyphicon-thumbs-up">  Like</span></a><br></br><span id="post_'. $post['post_id'].'_likes"> '.$post["number_likes"].'</span> Liked This.</p>
                                    <hr>
                                    <div class="input-group">
                                    <div class="input-group-addon"><a href=""><span class="glyphicon glyphicon-comment"></span></a></div>
                                    <input type="text" name="comment" class="form-control">
                                    </div>
                                </form>
                                </div>
                                </li>';
                            }
                        }
                        //}
                        
                        
        }else{
            echo '<div class="alert alert-danger" role="alert"><strong>No Reults Found !!</strong></div>';   
        }?>
        	</ul>
        </div>
 </div>
 	

 </div>
</body>
</html>