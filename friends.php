<?php include 'header.php'; ?>

<div id="covering">
	<div class="container">
		
    <form method="post" action="Requests.php">
    <button class="btn btn-placing pull-right" type="Submit">
      Show Requests
    </button>
    </form>
		
		
  		<img src="<?php echo $profile_pic; ?>" class="img-properties" alt="ProfilePicture">
		<span class="username"><?php  echo $username; ?></span>
	</div>
	</div>


	<div class="container">

		<div class="row">
    <div class="col-md-10 col-md-offset-1 whitebox float-to-left">
      <h4 class="title-friend">Friends </h4>
    <?php 

    $friends = browse_friends();
    $counter = 0;
    if(!empty($friends)){
    foreach ($friends as $friend) {
      $friend["picture_path"] = 'images/'.$friend["picture_path"];
      if ($friend['user_nname'] == '') {
        $username = $friend['user_fname'].' '.$friend['user_lname'];
      }else{
        $username = $friend['user_nname'];
      }
      if ($counter%2==0) {
        echo '
      <hr>
        <div class="col-md-5 border-friend">
          <img src="'.$friend["picture_path"].'" class="picture-friend float-to-left">
          <a class="Username" href="profile.php?username='.$username.'">'.$username.'</a>
          <form method="post" action="friendrequests.php">
            <input type="submit" class="btn pull-right" name="Decline" value="Delete"/>
            <input type="hidden" name="user_id" value="'.$friend["user_id"].'"></input>
            <input type="hidden" name="friend_id" value="'.$friend["friend_id"].'"></input> 
          </form>
        </div>';
      }else{
        echo '<hr>
        <div class="col-md-5 border-friend">
          <img src="'.$friend["picture_path"].'" class="picture-friend float-to-left">
          <a class="Username" href="profile.php?username='.$username.'">'.$username.'</a>
          <div class="dropdown pull-right">
                <button class="btn btn-unfriend dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Friends
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#">Unfriend</a></li>
                </ul>
            </div>
        </div>';
      }
    }
}
			
				?>
				
			</div>
		</div>
	</div>
  
  <script language='javascript' type='text/javascript'>
  
  
   var notif1;
  var notif2;

  function AJAXnot(){
    var data;
    $.ajax({
      type : 'GET',
      url : 'chknotif.php',
      data : {},
      async: false,
      success : function(response){
        
        data = response;
        
        }
    });
    return data;
   
  }
  
  function setnotify(){
  
  notif1=AJAXnot();
 
  }
  

  function chknotif()
  {
    
    notif2= AJAXnot();
    $(function(){
        setTimeout(function() {
        $.bootstrapGrowl("chk NOTIFICATION!", {
            type: 'danger',
            align: 'center',
            width: 'auto',
            allow_dismiss: false
        });
    }, 2000);
    });
  
  //alert("N@"+notif2);
  
  if(notif2>notif1)
  {
    alert("NEW");
    


      $(function(){
        setTimeout(function() {
        $.bootstrapGrowl("NEW NOTIFICATION!", {
            type: 'danger',
            align: 'center',
            width: 'auto',
            allow_dismiss: false
        });
    }, 2000);
    });
      alert ("DONE");    

    notif1=notif2;
  }
  else 
  {
  }
  
  }
  
  
  
  
  
  function call(){
    setnotify();
    setInterval(chknotif, 500);
  }
  
  
</script>
<script>call();</script>
	</body>
	</html>