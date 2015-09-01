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


echo "
<!DOCTYPE html>
<html>
<head>
<title>Home | Fakebook</title>
<link rel='stylesheet' href='homestyle.css'>
<link rel='stylesheet' href='indexstyle.css'>
</head>
<body>
";

include "header.php";

echo "
<div id='welcome' style='position:fixed;top:100px;line-height:25px;'>
Welcome Home, ".$username.".<br>
<ul>
<li><a href='upload.php'>Upload a new photo</a></li>
<li><a href='timeline.php?user=".$mail."'>View your profile</a></li>
</ul>
</div>";
echo "<div id='content' style='border-left:1px solid #ccc;position:absolute;top:200px;left:330px;padding-left:20px;width:900px;'>";
mysql_select_db('fakebook');
$results = mysql_query("SELECT * FROM photos order by id desc");


while ($row = mysql_fetch_array($results)){

$uploader = $row['uploader'];

$result_for_name = mysql_query("SELECT * FROM USER WHERE mail= '$uploader'") or die(mysql_error());

$row_for_name = mysql_fetch_array($result_for_name) or die(mysql_error());

$uploader_name = $row_for_name['user'];

echo "<a href=\"timeline.php?user=".$uploader."\">".$uploader_name."</a> uploaded a photo on ".$row['time']." , ".$row['date'].".<br>";
$category = "Human";$count=$row['human'];
if($count<$row['bird']){$category = "Bird";$count=$row['bird'];}
if($count<$row['animal']){$category = "Animal";$count=$row['animal'];}
if($count<$row['building']){$category = "Building";$count=$row['building'];}
if($count<$row['vehicle']){$category = "Vehicle";$count=$row['vehicle'];}
if($count<$row['object']){$category = "Object";$count=$row['object'];}
if($count<$row['ufo']){$category = "UFO";$count=$row['ufo'];}

echo "Category=".$category.".";

echo "<input type='button' value='Tag details' style='cursor:pointer;border: 1px solid  black;background-color:#78a3ef;padding: 4px;border-radius: 5px;' onClick=\"window.open('tagdetails.php?pic=".$row['id']."','mywindow','width=600,height=600,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=yes')\">";
if ($mail==$uploader){
echo "<input type='button' value='Delete' style='cursor:pointer;border: 1px solid  black;background-color:#78a3ef;padding: 4px;border-radius: 5px;' onClick=\"window.open('deletepic.php?pic=".$row['id']."','mywindow','width=600,height=600,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=yes')\">";
}
echo "<br><div style='position:absolute;left:560px;'>Category counts:<br> Human : ".$row['human']."<br>Bird : ".$row['bird']."<br>Animal : ".$row['animal']."<br>Building : ".$row['building']."<br>Vehicle : ".$row['vehicle']."<br>Object : ".$row['object']."<br>UFO : ".$row['ufo'].".<br></div>";

echo "<br><img src='upload/".$row['name']."' height=350 width=500 alt=\"".$row['name'].",".$row['uploader']."\"><br>";

echo "<form action='vote.php' method='post'>";

echo "<input type='hidden' name='photo' value='".$row['name']."'>Category :<select name='category' style='border-radius:4px;padding:4px;border:1px solid #A0A0A0;'>
<option selected value='human'> Human </option>
<option value='bird'> Bird </option>
<option value='animal'> Animal </option>
<option value='building'> Building </option>
<option value='vehicle'> Vehicle </option>
<option value='object'> Object </option>
<option value='ufo'> UFO </option>
</select> <input type='submit' value='Vote As' style='cursor:pointer;border-radius:4px;padding:4px;border:1px solid #A0A0A0;'>
</form><!--<hr style='color:#ccc;'>--><br><hr><br>";
}
echo "</div>
</body>
</html>";
	mysql_close($conn);
?>
