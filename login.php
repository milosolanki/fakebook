<?php
	$mail=$_POST['user'];
	$pass=$_POST['pass'];
	
	include "mysql_connect.php";
	
	mysql_select_db("fakebook",$conn);
	$result = mysql_query("SELECT * FROM USER WHERE mail='$mail'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	$user = $row['user'];
	$id=SHA1($row['id']);
	mysql_close($conn);
	echo "<br/>";
	echo $user."<br/>";
	echo $id."";

	if ($pass===$row['id']){
	setcookie("username",$user,time()+60*60*24*30);
	setcookie("email",$mail,time()+60*60*24*30);
	setcookie("id",$id,time()+60*60*24*30);
	header('Location: index.php');
	exit;
	}
	else {
	include 'login.html';
	echo "<script>alert('Your email or password was incorrect,retry');</script>";
	}
?>
