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

?>
<!DOCTYPE html>
<html>
<head>
<title>Content not found | Fakebook</title>
<link rel="stylesheet" href="homestyle.css">
<link rel="stylesheet" href="indexstyle.css">
</head>
<body style="text-align: center;">

<?php
	include "header.php";
?>
<div class="notice"> The content you requested for has been removed from<br><b>Fakebook</b>, or you don't have sufficient permissions to do so.<br>Please contact us or content owner for further details.</div>

</body>
</html>
