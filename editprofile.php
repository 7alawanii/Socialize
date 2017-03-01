<?php 
include 'header.php';
include 'connection.php'; 
$user_id=$_SESSION['user_id'];
#$user_id=9;
if ($nickname != '' || $nickname != NULL) {
  $username = $nickname;
}

if (isset($_POST['edit'])) {
  #$user_id=$_SESSION['user_id'];
  $query = "UPDATE `users` SET `user_fname` = '".mysqli_real_escape_string($link,$_POST['fname'])."' ,`user_lname` = '".mysqli_real_escape_string($link,$_POST['lname'])."' ,`user_nname` = '".mysqli_real_escape_string($link,$_POST['nname'])."',`user_about` = '".mysqli_real_escape_string($link,$_POST['aboutme'])."',`user_hometown` = '".mysqli_real_escape_string($link,$_POST['hometown'])."' ,`user_marital` = '".mysqli_real_escape_string($link,$_POST['marital'])."'  WHERE `users`.`user_id` = '".$user_id."'";
  mysqli_query($link,$query);
  $sql1 = "SELECT `phone_number` FROM `phones` WHERE `user_id` = '".$user_id."'";
  $result1= mysqli_query($link , $sql1);
  $num_res1 = mysqli_num_rows($result1);
  $sqldelete = "TRUNCATE TABLE `phones`";
  mysqli_query($link , $sqldelete);
  
  while($num_res1 > 0){
    $num = 'phone_'.$num_res1;
    $query2 = "INSERT INTO `phones` (`user_id` , `phone_number`) VALUES ('".$user_id."','".mysqli_real_escape_string($link,$_POST[$num])."')";
    mysqli_query($link,$query2);
    $num_res1 -= 1;
  }
  if (mysqli_real_escape_string($link,$_POST['phone_0']) != ''){
  $query1 = "INSERT INTO `phones` (`user_id` , `phone_number`) VALUES ('".$user_id."','".mysqli_real_escape_string($link,$_POST['phone_0'])."')";
  mysqli_query($link,$query1);
}
}
$sql = "SELECT `user_fname`,`user_lname`,`user_nname`,`user_about`,`user_hometown`,`user_marital` FROM `users` WHERE `user_id` = '".$user_id."'";
$result = mysqli_query($link , $sql);
$result = mysqli_fetch_array($result);
$fname = $result['user_fname'];
$lname = $result['user_lname'];
$nname = $result['user_nname'];
$mobile = '';
$about = $result['user_about'];
$hometown = $result['user_hometown'];
$marital = $result['user_marital'];

$sql2 = "SELECT `phone_number` FROM `phones` WHERE `user_id` = '".$user_id."'";
$result2= mysqli_query($link , $sql2);
$num_res2 = mysqli_num_rows($result2);
$phones = array();
$phones[0]='';
$counter = 0;
while($rowf = mysqli_fetch_array($result2)){
    $phones[$counter] = $rowf[0];
    $counter = $counter + 1;
    $phones[$counter] = '';
}
$i = 0;
if ($nickname != '' || $nickname != NULL) {
  $username = $nname;
}else{
  $username = $fname.' '.$lname;
}
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo $username;
?>
<html>
<head>
</head>
<body>
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
    
<div class="col-md-offset-5 col-md-6">
        <div>
        <h3></h3>
      </div>
        <form class="form" onsubmit = "" method="POST">
          <div class="form-group">
          Firstname
            <input type="text" name="fname" id="fname" class="form-control" placeholder="Your Firstname"
            value="<?php if ($fname != NULL) echo $fname; ?>">
          </div>
          <div class="form-group">
          Lastname
            <input type="text" name="lname" id="lname" class="form-control" placeholder="Your Lastname"
            value="<?php if ($lname != NULL) echo $lname; ?>">
          </div>
          <div class="form-group">
          Nickname
            <input type="text" name="nname" id="nname" class="form-control" placeholder="Your Nickname"
            value="<?php if ($nname != NULL) echo $nname; ?>">
          </div>
          <div class="form-group">
          Phone Number(s)
          <?php while($counter >= 0){ ?>
            <input type="text" name="phone_<?php echo $counter;?>" id="phone_<?php echo $counter;?>" class="form-control" placeholder="Your New Phone Number"
            value="<?php if ($phones[$i] != '') echo $phones[$i]; ?>"><br></br><?php $counter -= 1;
            $i += 1;}?>
          </div>
          <div class="form-group">
          About me
            <input type="text" name="aboutme" id="aboutme" class="form-control" placeholder="About Me"
            value="<?php if ($about != NULL) echo about; ?>">
          </div>
          
          <div class="form-group">
            <label>Hometown</label>
          </div>
          <div class="form-group">
             <select name="hometown" class="form-control">

  <option value="select" title="select" <?php if($hometown == NULL) echo "selected"; ?>>Select Your Hometown</option>
  <option value="Afghanistan" title="Afghanistan" <?php if($hometown == "Afghanistan") echo "selected"; ?>>Afghanistan</option>
  <option value="Albania" title="Albania" <?php if($hometown == "Albania") echo "selected"; ?>>Albania</option>
  <option value="Algeria" title="Algeria" <?php if($hometown == "Algeria") echo "selected"; ?>>Algeria</option>
  <option value="Andorra" title="Andorra" <?php if($hometown == "Andorra") echo "selected"; ?>>Andorra</option>
  <option value="Angola" title="Angola" <?php if($hometown == "Angola") echo "selected"; ?>>Angola</option>
  <option value="Anguilla" title="Anguilla" <?php if($hometown == "Anguilla") echo "selected"; ?>>Anguilla</option>
  <option value="Antarctica" title="Antarctica" <?php if($hometown == "Antarctica") echo "selected"; ?>>Antarctica</option>
  <option value="Antigua and Barbuda" title="Antigua and Barbuda" <?php if($hometown == "Antigua and Barbuda") echo "selected"; ?>>Antigua and Barbuda</option>
  <option value="Argentina" title="Argentina" <?php if($hometown == "Argentina") echo "selected"; ?>>Argentina</option>
  <option value="Armenia" title="Armenia" <?php if($hometown == "Armenia") echo "selected"; ?>>Armenia</option>
  <option value="Australia" title="Australia" <?php if($hometown == "Australia") echo "selected"; ?>>Australia</option>
  <option value="Austria" title="Austria" <?php if($hometown == "Austria") echo "selected"; ?>>Austria</option>
  <option value="Azerbaijan" title="Azerbaijan" <?php if($hometown == "Azerbaijan") echo "selected"; ?>>Azerbaijan</option>
  <option value="Bahamas" title="Bahamas" <?php if($hometown == "Bahamas") echo "selected"; ?>>Bahamas</option>
  <option value="Bahrain" title="Bahrain" <?php if($hometown == "Bahrain") echo "selected"; ?>>Bahrain</option>
  <option value="Bangladesh" title="Bangladesh" <?php if($hometown == "Bangladesh") echo "selected"; ?>>Bangladesh</option>
  <option value="Belarus" title="Belarus" <?php if($hometown == "Belarus") echo "selected"; ?>>Belarus</option>
  <option value="Belgium" title="Belgium" <?php if($hometown == "Belgium") echo "selected"; ?>>Belgium</option>
  <option value="Benin" title="Benin" <?php if($hometown == "Benin") echo "selected"; ?>>Benin</option>
  <option value="Bermuda" title="Bermuda" <?php if($hometown == "Bermuda") echo "selected"; ?>>Bermuda</option>
  <option value="Bolivia" title="Bolivia" <?php if($hometown == "Bolivia") echo "selected"; ?>>Bolivia</option>
  <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina" <?php if($hometown == "Bosnia and Herzegovina") echo "selected"; ?>>Bosnia and Herzegovina</option>
  <option value="Botswana" title="Botswana" <?php if($hometown == "Botswana") echo "selected"; ?>>Botswana</option>
  <option value="Brazil" title="Brazil" <?php if($hometown == "Brazil") echo "selected"; ?>>Brazil</option>
  <option value="Bulgaria" title="Bulgaria" <?php if($hometown == "Bulgaria") echo "selected"; ?>>Bulgaria</option>
  <option value="Burkina Faso" title="Burkina Faso" <?php if($hometown == "Burkina Faso") echo "selected"; ?>>Burkina Faso</option>
  <option value="Burundi" title="Burundi" <?php if($hometown == "Burundi") echo "selected"; ?>>Burundi</option>
  <option value="Cambodia" title="Cambodia" <?php if($hometown == "Cambodia") echo "selected"; ?>>Cambodia</option>
  <option value="Cameroon" title="Cameroon" <?php if($hometown == "Cameroon") echo "selected"; ?>>Cameroon</option>
  <option value="Canada" title="Canada" <?php if($hometown == "Canada") echo "selected"; ?>>Canada</option>
  <option value="Cape Verde" title="Cape Verde" <?php if($hometown == "Cape Verde") echo "selected"; ?>>Cape Verde</option>
  <option value="Chad" title="Chad" <?php if($hometown == "Chad") echo "selected"; ?>>Chad</option>
  <option value="Chile" title="Chile" <?php if($hometown == "Chile") echo "selected"; ?>>Chile</option>
  <option value="China" title="China" <?php if($hometown == "China") echo "selected"; ?>>China</option>
  <option value="Colombia" title="Colombia" <?php if($hometown == "Colombia") echo "selected"; ?>>Colombia</option>
  <option value="Congo" title="Congo" <?php if($hometown == "Congo") echo "selected"; ?>>Congo</option>
  <option value="Costa Rica" title="Costa Rica" <?php if($hometown == "Costa Rica") echo "selected"; ?>>Costa Rica</option>
  <option value="Côte d'Ivoire" title="Côte d'Ivoire" <?php if($hometown == "Côte d'Ivoire") echo "selected"; ?>>Côte d'Ivoire</option>
  <option value="Croatia" title="Croatia" <?php if($hometown == "Croatia") echo "selected"; ?>>Croatia</option>
  <option value="Cuba" title="Cuba" <?php if($hometown == "Cuba") echo "selected"; ?>>Cuba</option>
  <option value="Cyprus" title="Cyprus" <?php if($hometown == "Cyprus") echo "selected"; ?>>Cyprus</option>
  <option value="Czech Republic" title="Czech Republic" <?php if($hometown == "Czech Republic") echo "selected"; ?>>Czech Republic</option>
  <option value="Denmark" title="Denmark" <?php if($hometown == "Denmark") echo "selected"; ?>>Denmark</option>
  <option value="Djibouti" title="Djibouti" <?php if($hometown == "Djibouti") echo "selected"; ?>>Djibouti</option>
  <option value="Dominica" title="Dominica" <?php if($hometown == "Dominica") echo "selected"; ?>>Dominica</option>
  <option value="Ecuador" title="Ecuador" <?php if($hometown == "Ecuador") echo "selected"; ?>>Ecuador</option>
  <option value="Egypt" title="Egypt" <?php if($hometown == "Egypt") echo "selected"; ?>>Egypt</option>
  <option value="El Salvador" title="El Salvador" <?php if($hometown == "El Salvador") echo "selected"; ?>>El Salvador</option>
  <option value="Eritrea" title="Eritrea" <?php if($hometown == "Eritrea") echo "selected"; ?>>Eritrea</option>
  <option value="Estonia" title="Estonia" <?php if($hometown == "Estonia") echo "selected"; ?>>Estonia</option>
  <option value="Ethiopia" title="Ethiopia" <?php if($hometown == "Ethiopia") echo "selected"; ?>>Ethiopia</option>
  <option value="Faroe Islands" title="Faroe Islands" <?php if($hometown == "Faroe Islands") echo "selected"; ?>>Faroe Islands</option>
  <option value="Fiji" title="Fiji" <?php if($hometown == "Fiji") echo "selected"; ?>>Fiji</option>
  <option value="Finland" title="Finland" <?php if($hometown == "Finland") echo "selected"; ?>>Finland</option>
  <option value="France" title="France" <?php if($hometown == "France") echo "selected"; ?>>France</option>
  <option value="Gabon" title="Gabon" <?php if($hometown == "Gabon") echo "selected"; ?>>Gabon</option>
  <option value="Gambia" title="Gambia" <?php if($hometown == "Gambia") echo "selected"; ?>>Gambia</option>
  <option value="Georgia" title="Georgia" <?php if($hometown == "Georgia") echo "selected"; ?>>Georgia</option>
  <option value="Germany" title="Germany" <?php if($hometown == "Germany") echo "selected"; ?>>Germany</option>
  <option value="Ghana" title="Ghana" <?php if($hometown == "Ghana") echo "selected"; ?>>Ghana</option>
  <option value="Greece" title="Greece" <?php if($hometown == "Greece") echo "selected"; ?>>Greece</option>
  <option value="Greenland" title="Greenland" <?php if($hometown == "Greenland") echo "selected"; ?>>Greenland</option>
  <option value="Haiti" title="Haiti" <?php if($hometown == "Haiti") echo "selected"; ?>>Haiti</option>
  <option value="Honduras" title="Honduras" <?php if($hometown == "Honduras") echo "selected"; ?>>Honduras</option>
  <option value="Hong Kong" title="Hong Kong" <?php if($hometown == "Hong Kong") echo "selected"; ?>>Hong Kong</option>
  <option value="Hungary" title="Hungary" <?php if($hometown == "Hungary") echo "selected"; ?>>Hungary</option>
  <option value="Iceland" title="Iceland" <?php if($hometown == "Iceland") echo "selected"; ?>>Iceland</option>
  <option value="India" title="India" <?php if($hometown == "India") echo "selected"; ?>>India</option>
  <option value="Indonesia" title="Indonesia" <?php if($hometown == "Indonesia") echo "selected"; ?>>Indonesia</option>
  <option value="Iran" title="Iran" <?php if($hometown == "Iran") echo "selected"; ?>>Iran</option>
  <option value="Iraq" title="Iraq" <?php if($hometown == "Iraq") echo "selected"; ?>>Iraq</option>
  <option value="Ireland" title="Ireland" <?php if($hometown == "Ireland") echo "selected"; ?>>Ireland</option>
  <option value="Italy" title="Italy" <?php if($hometown == "Italy") echo "selected"; ?>>Italy</option>
  <option value="Jamaica" title="Jamaica" <?php if($hometown == "Jamaica") echo "selected"; ?>>Jamaica</option>
  <option value="Japan" title="Japan" <?php if($hometown == "Japan") echo "selected"; ?>>Japan</option>
  <option value="Jordan" title="Jordan" <?php if($hometown == "Jordan") echo "selected"; ?>>Jordan</option>
  <option value="Kazakhstan" title="Kazakhstan" <?php if($hometown == "Kazakhstan") echo "selected"; ?>>Kazakhstan</option>
  <option value="Kenya" title="Kenya" <?php if($hometown == "Kenya") echo "selected"; ?>>Kenya</option>
  <option value="Korea" title="Korea" <?php if($hometown == "Korea") echo "selected"; ?>>Korea</option>
  <option value="Kuwait" title="Kuwait" <?php if($hometown == "Kuwait") echo "selected"; ?>>Kuwait</option>
  <option value="Latvia" title="Latvia" <?php if($hometown == "Latvia") echo "selected"; ?>>Latvia</option>
  <option value="Lebanon" title="Lebanon" <?php if($hometown == "Lebanon") echo "selected"; ?>>Lebanon</option>
  <option value="Liberia" title="Liberia" <?php if($hometown == "Liberia") echo "selected"; ?>>Liberia</option>
  <option value="Libya" title="Libya" <?php if($hometown == "Libya") echo "selected"; ?>>Libya</option>
  <option value="Liechtenstein" title="Liechtenstein" <?php if($hometown == "Liechtenstein") echo "selected"; ?>>Liechtenstein</option>
  <option value="Lithuania" title="Lithuania" <?php if($hometown == "Lithuania") echo "selected"; ?>>Lithuania</option>
  <option value="Luxembourg" title="Luxembourg" <?php if($hometown == "Luxembourg") echo "selected"; ?>>Luxembourg</option>
  <option value="Macao" title="Macao" <?php if($hometown == "Macao") echo "selected"; ?>>Macao</option>
  <option value="Macedonia" title="Macedonia" <?php if($hometown == "Macedonia") echo "selected"; ?>>Macedonia</option>
  <option value="Madagascar" title="Madagascar" <?php if($hometown == "Madagascar") echo "selected"; ?>>Madagascar</option>
  <option value="Malawi" title="Malawi" <?php if($hometown == "Malawi") echo "selected"; ?>>Malawi</option>
  <option value="Malaysia" title="Malaysia" <?php if($hometown == "Malaysia") echo "selected"; ?>>Malaysia</option>
  <option value="Maldives" title="Maldives" <?php if($hometown == "Maldives") echo "selected"; ?>>Maldives</option>
  <option value="Mali" title="Mali" <?php if($hometown == "Mali") echo "selected"; ?>>Mali</option>
  <option value="Malta" title="Malta" <?php if($hometown == "Malta") echo "selected"; ?>>Malta</option>
  <option value="Mexico" title="Mexico" <?php if($hometown == "Mexico") echo "selected"; ?>>Mexico</option>
  <option value="Moldova" title="Moldova" <?php if($hometown == "Moldova") echo "selected"; ?>>Moldova</option>
  <option value="Montenegro" title="Montenegro" <?php if($hometown == "Montenegro") echo "selected"; ?>>Montenegro</option>
  <option value="Morocco" title="Morocco" <?php if($hometown == "Morocco") echo "selected"; ?>>Morocco</option>
  <option value="Mozambique" title="Mozambique" <?php if($hometown == "Mozambique") echo "selected"; ?>>Mozambique</option>
  <option value="Namibia" title="Namibia" <?php if($hometown == "Namibia") echo "selected"; ?>>Namibia</option>
  <option value="Nepal" title="Nepal" <?php if($hometown == "Nepal") echo "selected"; ?>>Nepal</option>
  <option value="Netherlands" title="Netherlands" <?php if($hometown == "Netherlands") echo "selected"; ?>>Netherlands</option>
  <option value="New Zealand" title="New Zealand" <?php if($hometown == "New Zealand") echo "selected"; ?>>New Zealand</option>
  <option value="Nigeria" title="Nigeria" <?php if($hometown == "Nigeria") echo "selected"; ?>>Nigeria</option>
  <option value="Norway" title="Norway" <?php if($hometown == "Norway") echo "selected"; ?>>Norway</option>
  <option value="Oman" title="Oman" <?php if($hometown == "Oman") echo "selected"; ?>>Oman</option>
  <option value="Pakistan" title="Pakistan" <?php if($hometown == "Pakistan") echo "selected"; ?>>Pakistan</option>
  <option value="Palestinian" title="Palestinian" <?php if($hometown == "Palestinian") echo "selected"; ?>>Palestinian</option>
  <option value="Panama" title="Panama" <?php if($hometown == "Panama") echo "selected"; ?>>Panama</option>
  <option value="Paraguay" title="Paraguay" <?php if($hometown == "Paraguay") echo "selected"; ?>>Paraguay</option>
  <option value="Peru" title="Peru" <?php if($hometown == "Peru") echo "selected"; ?>>Peru</option>
  <option value="Philippines" title="Philippines" <?php if($hometown == "Philippines") echo "selected"; ?>>Philippines</option>
  <option value="Poland" title="Poland" <?php if($hometown == "Poland") echo "selected"; ?>>Poland</option>
  <option value="Portugal" title="Portugal" <?php if($hometown == "Portugal") echo "selected"; ?>>Portugal</option>
  <option value="Puerto Rico" title="Puerto Rico" <?php if($hometown == "Puerto Rico") echo "selected"; ?>>Puerto Rico</option>
  <option value="Qatar" title="Qatar" <?php if($hometown == "Qatar") echo "selected"; ?>>Qatar</option>
  <option value="Romania" title="Romania" <?php if($hometown == "Romania") echo "selected"; ?>>Romania</option>
  <option value="Russia" title="Russia" <?php if($hometown == "Russia") echo "selected"; ?>>Russia</option>
  <option value="Rwanda" title="Rwanda" <?php if($hometown == "Rwanda") echo "selected"; ?>>Rwanda</option>
  <option value="San Marino" title="San Marino" <?php if($hometown == "San Marino") echo "selected"; ?>>San Marino</option>
  <option value="Saudi Arabia" title="Saudi Arabia" <?php if($hometown == "Saudi Arabia") echo "selected"; ?>>Saudi Arabia</option>
  <option value="Senegal" title="Senegal" <?php if($hometown == "Senegal") echo "selected"; ?>>Senegal</option>
  <option value="Serbia" title="Serbia" <?php if($hometown == "Serbia") echo "selected"; ?>>Serbia</option>
  <option value="Singapore" title="Singapore" <?php if($hometown == "Singapore") echo "selected"; ?>>Singapore</option>n>
  <option value="Slovakia" title="Slovakia" <?php if($hometown == "Slovakia") echo "selected"; ?>>Slovakia</option>
  <option value="Slovenia" title="Slovenia" <?php if($hometown == "Slovenia") echo "selected"; ?>>Slovenia</option>
  <option value="South Africa" title="South Africa" <?php if($hometown == "South Africa") echo "selected"; ?>>South Africa</option>
  <option value="Spain" title="Spain" <?php if($hometown == "Spain") echo "selected"; ?>>Spain</option>
  <option value="Sri Lanka" title="Sri Lanka" <?php if($hometown == "Sri Lanka") echo "selected"; ?>>Sri Lanka</option>
  <option value="Sudan" title="Sudan" <?php if($hometown == "Sudan") echo "selected"; ?>>Sudan</option>
  <option value="Sweden" title="Sweden" <?php if($hometown == "Sweden") echo "selected"; ?>>Sweden</option>
  <option value="Switzerland" title="Switzerland" <?php if($hometown == "Switzerland") echo "selected"; ?>>Switzerland</option>
  <option value="Syrian" title="Syria" <?php if($hometown == "Syria") echo "selected"; ?>>Syria</option>
  <option value="Taiwan" title="Taiwan" <?php if($hometown == "Taiwan") echo "selected"; ?>>Taiwan</option>
  <option value="Thailand" title="Thailand" <?php if($hometown == "Thailand") echo "selected"; ?>>Thailand</option>
  <option value="Trinidad and Tobago" title="Trinidad and Tobago" <?php if($hometown == "Trinidad and Tobago") echo "selected"; ?>>Trinidad and Tobago</option>
  <option value="Tunisia" title="Tunisia" <?php if($hometown == "Tunisia") echo "selected"; ?>>Tunisia</option>
  <option value="Turkey" title="Turkey" <?php if($hometown == "Turkey") echo "selected"; ?>>Turkey</option>
  <option value="Uganda" title="Uganda" <?php if($hometown == "Uganda") echo "selected"; ?>>Uganda</option>
  <option value="Ukraine" title="Ukraine" <?php if($hometown == "Ukraine") echo "selected"; ?>>Ukraine</option>
  <option value="United Arab Emirates" title="United Arab Emirates" <?php if($hometown == "United Arab Emirates") echo "selected"; ?>>United Arab Emirates</option>
  <option value="United Kingdom" title="United Kingdom" <?php if($hometown == "United Kingdom") echo "selected"; ?>>United Kingdom</option>
  <option value="United States" title="United States" <?php if($hometown == "United States") echo "selected"; ?>>United States</option>
  <option value="Uruguay" title="Uruguay" <?php if($hometown == "Uruguay") echo "selected"; ?>>Uruguay</option>
  <option value="Uzbekistan" title="Uzbekistan" <?php if($hometown == "Uzbekistan") echo "selected"; ?>>Uzbekistan</option>
  <option value="Vanuatu" title="Vanuatu" <?php if($hometown == "Vanuatu") echo "selected"; ?>>Vanuatu</option>
  <option value="Venezuela" title="Venezuela" <?php if($hometown == "Venezuela") echo "selected"; ?>>Venezuela</option>
  <option value="Viet Nam" title="Viet Nam" <?php if($hometown == "Viet Nam") echo "selected"; ?>>Viet Nam</option>
  <option value="Yemen" title="Yemen" <?php if($hometown == "Yemen") echo "selected"; ?>>Yemen</option>
  <option value="Zambia" title="Zambia" <?php if($hometown == "Zambia") echo "selected"; ?>>Zambia</option>
  <option value="Zimbabwe" title="Zimbabwe" <?php if($hometown == "Zimbabwe") echo "selected"; ?>>Zimbabwe</option>
</select>
          </div>

          <div class="form-group">
            <label>Marital Status</label>
          </div>
          
          <div class="form-group">
            
            <select name="marital" class = "form-control">
                                <option value="0" <?php if($marital == NULL) echo "selected"; ?>>Your Marital Status</option><option value="Single" <?php if($marital == "Single") echo "selected"; ?>>Single</option><option value="Engaged" <?php if($marital == "Engaged") echo "selected"; ?>>Engaged</option><option value="Married" <?php if($marital == "Married") echo "selected"; ?>>Married</option>
                                
            </select>
          </div>


          
          
          <br><br>
          <div class="form-group">
                <input class="btn btn-lg btn-block signup-btn" type="submit" name="edit" value="Edit my Profile">
          </div>
  
        </form>
        <br>
        </div>

  </div>
</div>
</body>
</html>

