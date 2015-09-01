<?php
 	$name=$_POST['name'];
	$mail=$_POST['user'];
	$pass=$_POST['pass'];
	$date=$_POST['date'];
	$month=$_POST['month'];
	
	
	include "mysql_connect.php";
	
	mysql_select_db("fakebook",$conn);
	$result = mysql_query("SELECT * from USER WHERE mail='$mail'")or die(mysql_error());
	$row = mysql_fetch_array($result);
	$id = $row['mail'];
	if($id==$mail)
	{
		echo "<script>alert('Mail already registered');</script>";
	}
	else
	{
		mysql_query("INSERT INTO USER(user,mail,id,date,month) VALUES('$name','$mail','$pass','$date','$month')");
		include 'login.html';
		exit;
	}
?>
