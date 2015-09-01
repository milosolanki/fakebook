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

$pic_id = $_POST['pic_id'];
$pic_uploader = $_POST['pic_uploader'];

if ($pic_uploader !== $mail){
	echo "Sorry, you are not authorised to perform this action, only uploader can...";
	exit;
}
else {
	include "mysql_connect.php";
	$results = mysql_query("SELECT * FROM PHOTOS where id='$pic_id'") or die(mysql_error());
	$row = mysql_fetch_array($results);
	$name = $row['name'];
	$table = "t".$pic_id;
	unlink("upload/".$name);
	
	mysql_query("DELETE from PHOTOS where id='$pic_id' and uploader='$pic_uploader'") or die(mysql_error());	
	mysql_query("DELETE from VOTE where id='$pic_id'") or die(mysql_error());	
	
	mysql_query("DROP TABLE $table") or die(mysql_error());
	echo "Success. The pic has been deleted";
	exit;
}

?>