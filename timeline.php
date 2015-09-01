<?php
	if(isset($_COOKIE['username'])){
		$user=$_COOKIE['username'];
	}
	else {header("Location: login.html");exit;}

	if(isset($_COOKIE['email'])){
		$mail=$_COOKIE['email'];
	}
	else {header("Location: login.html");exit;}

	if(isset($_COOKIE['id'])){
		$id=$_COOKIE['id'];
	}
	else {header("Location: login.html");exit;}

	
	include "mysql_connect.php";
	
	mysql_select_db("fakebook");
	$result=mysql_query("SELECT * FROM USER WHERE mail='$mail'") or die(mysql_error());
	$row = mysql_fetch_array($result) or die(mysql_error());
	$username=$row['user'];
	$email = $row['mail'];
	$pass = SHA1($row['id']);
	if ($username!== $user){header("Location: login.html");exit;}
	else if ($email!==$mail) {header("Location: login.html");exit;}
	else if ($pass!== $id) {header("Location: login.html");exit;}

$email = $_GET['user'];
if ($mail == $email) { $your_profile="TRUE"; }
else { $your_profile="FALSE"; }
$result = mysql_query("SELECT * FROM USER where mail='$email'") or die(mysql_error());
if (mysql_num_rows($result)< 1) header("Location: show_404.php");
	
$row = mysql_fetch_array($result) or die(mysql_error());
$profile_holder = $row['user'];
echo "
<!DOCTYPE html>
<html>
<head>
<title>".$profile_holder." | Fakebook</title>
<link rel='stylesheet' href='homestyle.css'>
<link rel='stylesheet' href='indexstyle.css'>
<script src='jquery.js'></script>
<script type='text/javascript'>
$(document).ready(function(){
	$('#make-editable').click(function(){
		alert('Editable');
	});
});
</script>
</head>
<body>
";

include "header.php";
?>
<div style="position: absolute;width: 100%;top: 50px;">
	<div id="profile-holder" style="margin-top:40px;margin-left:100px;font-size:40px;cursor:pointer;letter-spacing:1.5px;"><b><?php echo ucfirst($profile_holder) ;?></b></div>
	
	<div id="profile-pic"><img src="profile_pics/default.jpg" width=150 height=120  style="border-radius:4px;position:absolute;right:200px;top:40px;border:1px solid black;"></div>
	<?php $gen = $row['gender'];
		if ($gen == "m") {$gen = "Male";}
		else if ($gen == "f") {$gen = "Female";}
		else {$gen = "Other or Unspecified";}
		$date = $row['date'];
		$month = $row['month'];
		$home = $row['hometown'];
		$current = $row['curtown'];
		switch($month){
		case("1") : $month = "January"; $max_days = 31; break;
		case("2") : $month = "February"; $max_days = 29; break;
		case("3") : $month = "March"; $max_days = 31; break;
		case("4") : $month = "April"; $max_days = 30; break;
		case("5") : $month = "May"; $max_days = 31; break;
		case("6") : $month = "June"; $max_days = 30; break;
		case("7") : $month = "July"; $max_days = 31; break;
		case("8") : $month = "August"; $max_days = 31; break;
		case("9") : $month = "September"; $max_days = 30; break;
		case("10") : $month = "October"; $max_days = 31; break;
		case("11") : $month = "November"; $max_days = 30; break;
		case("12") : $month = "December"; $max_days = 31; break;
		
			default : $month = "";$date="";break;
		}
		if ($date < 1 || $date > $max_days) $month = "";
		$about = $row['about'];
	?>
	<div id="basic-details" style="width:17%;text-align:right;line-height:30px;padding:40px;padding-right:6px;border-radius:5px;position:absolute;right:200px;top:150px;margin-top:20px;">
	<span  id="make-editable"style="text-decoration:underline;background-color: white;padding:5px;cursor:pointer;">Edit info</span><br><br>
	Gender : <b><?php echo $gen;?></b><br>
	Birthday : <b><?php if ($month == "") echo "Invalid Date Saved"; else echo $month.", ".$date; ?></b><br>
	Hometown : <b><?php echo $home; ?></b><br>
	Currently in : <b><?php echo $current; ?></b><br>
	About : <?php if ($about !== "") echo $about; else echo "<b>Not edited</b>"; ?><br>
	</div>
</div>

</body>
</html>
<?php
mysql_close($conn);
?>
