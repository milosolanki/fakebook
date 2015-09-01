<?php

	
	include "mysql_connect.php";
	
	mysql_select_db("fakebook") or die(mysql_error());
	$name=$_POST['name'];
	$top=$_POST['top'];
	$left=$_POST['left'];
	$t=$_POST['table'];
	$tagger = $_COOKIE['email'];
	$results=mysql_query("SELECT * FROM $t where tagger like '%$tagger%'") or die(mysql_error());

	if (mysql_num_rows($results)>0){
		echo "You have already tagged this picture";
	}
	else {
	$results = mysql_query("SELECT * from $t where name='$name'") or die(mysql_error());
	if (mysql_num_rows($results) > 0){
		$row=mysql_fetch_array($results);
		$count=$row['count']+1;
		$tagger=$tagger.",";
		mysql_query("UPDATE $t SET count='$count',tagger=CONCAT('$tagger',tagger) where name='$name'") or die(mysql_error());
		echo "The tag existed,your vote has been counted";
		}
	else{
	$count=1;
	mysql_query("INSERT INTO $t VALUES('','$name','$count','$tagger','$top','$left')") or die(mysql_error());
	echo "The photo has been tagged";
	}
	}
	mysql_close($conn);
?>
