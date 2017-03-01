/*alert('hereee');
$(document).ready(function(){
	alert("farida");
	$('.like').click(function(){
		alert('ahmed');
		var postid = $(this).attr('id');
		$.ajax({
			url:'home.php',
			type: 'post',
			async: false,
			data:{
				'liked': 1;,
				'postid': postid,
			},
			success:function(){

			}
		});
	});
});*/

function check_availabilty_username(){
	$name = $("#username").val();

	if($name){

		$.ajax({
			type : 'POST',
			url : 'check_ajax.php',
			data : {username:$name,},
			success : function(response){
				$("#alerting").html(response);
				if(response == "OK"){
					return true;
				}
				else{
					return false;
				}
			}
		});
	}
	else{
		$("#alerting").html("");
	}
}


function check_availabilty_email(){
	$email = $("#email").val();

	if($email){

		$.ajax({
			type : 'POST',
			url : 'check_ajax.php',
			data : {useremail:$email,},
			success : function(response){
				$("#alerting1").html(response);
				if(response == "OK"){
					return true;
				}
				else{
					return false;
				}
			}
		});
	}
	else{
		$("#alerting1").html("");
	}
}


function remove_span(){
	$("#error").html("");
}



function check_validity(){
	alert("faridaaaaaaaaaaa");
	$fname = $("#fname").val();
	$lname = $("#lname").val();
	$email = $("#email").val();
	$password = $("#password").val();
	$confirm = $("#confirm").val();
	var m = document.getElementById("month");
	var month = m.options[m.selectedIndex].text;
	var d = document.getElementById("day");
	var day = d.options[d.selectedIndex].text;
	var y = document.getElementById("year");
	var year = y.options[y.selectedIndex].text;
	//$fname-error = $lname-error = $email-error = $password-error =$confirm-error= $confirmation-error = $month-error = $day-error = $year-error = $gender-error = "";
	$error = "";
	flag = true;
	if($fname ==""){
		$error += "Please Enter your Firstname !!<br>";
		
	}
	if($lname ==""){
		$error+= "Please Enter your Lastname !!<br>";
		
	}

	if($email ==""){
		$error += "Please Enter your email !!<br>";
	}
	
	if($password ==""){
		$error += "Please Enter your password !!<br>";
	}
	if($confirm ==""){
		$error += "Please Confirm your password !!<br>";
	}
	if($password != $confirm){
		$error += "Please Confirm your password correctly !!<br>";
	}
	if(month == "Month"){
		$error += "Please Choose Month of birth !!<br>";
	}
	if(day == "Day"){
		$error += "Please Choose Day of birth !!<br>";
	}
	if(year == "Year"){
		$error += "Please Choose Year of birth !!<br>";
	}
	if (!document.getElementById('male').checked && !document.getElementById('female').checked) {
  		$error += "Please Choose Gender !!</br>";
	}

	/*if($fname-error != ""){
		alert("fffff");
		$("#fname-error").html($fname-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($lname-error != ""){
		alert("fffff");
		$("#lname-error").html($lname-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($email-error != ""){
		alert("fffff");
		$("#email-error").html($email-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($password-error != ""){
		alert("fffff");
		$("#password-error").html($password-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($Confirm-error != ""){
		alert("fffff");
		$("#Confirm-error").html($confirm-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($confirmation-error != ""){
		$("#confirmation-error").html($confirmation-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($month-error != "" || $day-error != "" || $year-error != ""){
		$("#date-error").html($month-error + $day-error + $year-error +'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}
	if($gender-error != ""){
		$("#gender-error").html($gender-error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		flag = false;
	}*/
	if ($error != ""){
		$("#error").html($error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
		return false;
	}
	else{
		return true;
	}

}





//var e = document.getElementById("privacy");
//var strUser = e.options[e.selectedIndex].value;
//alert(struser);
//function set_privacy() {
	
		$('option').click(function(){
			alert('faridaaa');
   			$privacy = $(this).attr('id');
   			alert($privacy);
   			/*$.ajax({
           		type: "POST",
           		url: 'ajax.php',
           		data:{privacy:$privacy}
           		
			

      		});*/
		});

      
 //}


function getvalue () {
        return alert("farida");
    }