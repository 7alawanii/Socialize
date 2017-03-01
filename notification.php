<?php include 'header.php' ; ?>





  

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
				<li>
					<div>
						<h5>Notifications</h5>
						<?php include 'not_view.php' ; ?>
						
					</div>
				</li>
	</ul>
</div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!---<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    Include all compiled plugins (below), or include individual files as needed 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/js/bootstrap.min.js"></script>
	<script src="jquery.bootstrap-growl.js"></script>
	<script src="jquery.bootstrap-growl.min.js"></script>-->

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
	  //$(function(){
        //setTimeout(function() {
       // $.bootstrapGrowl("chk NOTIFICATION!", {
         //   type: 'danger',
          //  align: 'center',
           // width: 'auto',
           // allow_dismiss: false
       // });
    //}, 2000);
   // });
	
	//alert("N@"+notif2);
	
	if(notif2>notif1)
	{
		//alert("NEW");
		


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