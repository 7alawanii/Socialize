<?php 
if (isset($_SESSION['user_id'])) {
  session_destroy(); 
}
?>
<?php include 'register.php'; ?>
<?php include 'login.php' ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Socialize</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

  <script type="text/javascript" src="scripts_index.js"></script>
    <script type="text/javascript">

     function check_login_validity(){
      $email = $("#loginemail").val();
      $password = $("#loginpassword").val();
  
      $loginerror = "";
      

      if($email == ""){
          $loginerror += "Please Enter your email !!\n";
    
      }
      if($password == ""){
        $loginerror += "Please Enter your password !!\n";
      }

      if($loginerror != ""){
          alert($loginerror);
          return false;
      }else{

          return true;
      }
      }


      function check_validity(){
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

  
  if ($error != ""){
    $("#error").html($error+'<button class="btn btn_danger" onclick="remove_span();">OK</button><br><br>');
    return false;
  }
  else{
    return true;
  }

}


function remove_span(){
  $("#error").html("");
}

    </script>

		<title>Socialize</title>


		
		
		
	</head>


	<body data-spy="scroll" data-target="#scrolling" class=" backgrnd">


<nav class="navbar navbar-custom navbar-fixed-top">
  <div class="container">

  <div class="navbar-header">
      <img src="images/global.png" class="float-to-left icon-placing">
      <a class="navbar-brand" href="home.php">Socialize</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse " id="scrolling">
        <form class=" navbar-form form-inline navbar-right" method="POST" action="<?php $_PHP_SELF ?>" onsubmit="return check_login_validity();">
          <div class="form-group">
            <input type="email" name="loginemail" id="loginemail" placeholder="Email" class="form-control">
            <input type="password" name="loginpassword" id="loginpassword" placeholder="Password" class="form-control">
            <input type="submit" name="login" id="login" value="Log In" class="btn" />
           
         
          </div>
        </form>
      </div>
  </div>
</nav>

      

  <div class="container">
    <div class="row">
    
      <div class="col-md-offset-4 col-md-6">
      <div>
        <h3>Sign Up</h3>
      </div>
      <div class="errorbox" >
            <span id="error"></span>
      </div>
        <form class="form" action="" method="POST" onsubmit="return check_validity();">
          <div class="form-group">
            <input type="text" name="fname" id="fname" placeholder="Firstname" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="lname" id="lname" placeholder="Lastname" class="form-control">
          </div>
          <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="phone" id="phone" placeholder="Phone number" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="confirm" id="confirm" placeholder="Confirm your password" class="form-control">
          </div>
          <div class="form-group">
            <label>Birth Date</label>
          </div>
          
          <div class="form-group col-md-4 float-to-left">
            
            <select name="month" id="month" class = "form-control">
                                <option value="00">Month</option>
                                <option value="01">Jan</option><option value="02">Feb</option><option value="03">Mar</option>
                                <option value="04">Apr</option><option value="05">May</option><option value="06">Jun</option>
                                <option value="07">Jul</option><option value="08">Aug</option><option value="09">Sep</option>
                                <option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option>
            </select>
          </div>
          <div class="form-group col-md-4 float-to-left">
            
            <select name="day" id="day" class = "form-control">
                                <option value="00">Day</option>
                                <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option>
                                <option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option>
                                <option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                <option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
                                <option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="21">21</option>
                                <option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
                                <option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option>
                                <option value="30">30</option><option value="31">31</option>
            </select>    
          </div>
          <div class="form-group col-md-4">
            
            <select name="year" id="year" class = "form-control">
                                <option value="00">Year</option>
                                <option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option>
                                <option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option>
                                <option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option>
                                <option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option>
                                <option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option>
                                <option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option>
                                <option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option>
                                <option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option>
                                <option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
                                <option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option>
                                <option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option>
                                <option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option>
                                <option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option>
                                <option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option>
                                <option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option>
                                <option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option>
                                <option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option>
                                <option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option>
                                <option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
                                <option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option>
                                <option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option>
                                <option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
                                <option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option>
                                <option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option>
                                <option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option>
                                <option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option>
                                <option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option>
                                <option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option>
                                <option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option>
                                <option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option>
                                <option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option>
                                <option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option>
                                <option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option>
                                <option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option>
                                <option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option>
                                <option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option>
                                <option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option>
                                <option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option>
                                <option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option>
                                </select>
                            </select>
          </div>
          <div class="form-group">
            <label>Gender</label>
          </div>
          <div class="form-group">
            <label class="radio-inline col-md-6">
                        <input type="radio" name="gender" value="M" id="male" />Male
            </label>
          </div>
          <div class="form-group">
            <label class="radio-inline col-md-6">
                        <input type="radio" name="gender" value="F" id="female" />Female
            </label>
          </div>
          <br><br>
          <div class="form-group">
            <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy.</span>
                <input class="btn btn-lg btn-block signup-btn" type="submit" name="signup" id="signup" value="Create my account"/>
          </div>
          
        </form>
        <br>
        <br>
      </div>
    </div>    
  </div>
	</body>
</html>