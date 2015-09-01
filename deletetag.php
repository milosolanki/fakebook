<?php

        include "mysql_connect.php";
        mysql_select_db("fakebook") or die(mysql_error());
	
	$t = $_POST['table'];
	$user=$_COOKIE['email'];

	$result = mysql_query("SELECT * FROM $t WHERE tagger like '%$user%'");
	$result1 = mysql_query("SELECT * FROM $t WHERE tagger like '%$user,%'");
	$result2 = mysql_query("SELECT * FROM $t WHERE tagger like '%,$user%'");

	if ((mysql_num_rows($result2)>=mysql_num_rows($result)) && mysql_num_rows($result2)>=mysql_num_rows($result1)){
		$user = ",".$user;
	}
	if (mysql_num_rows($result1)>=mysql_num_rows($result)){
		$user=$user.",";
	}
	if (mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		$count = $row['count'];
		$name=$row['name'];
		if ($count>1){
			$tagger=$row['tagger'];
			$count=$count-1;
			$tagger= str_replace("$user", "",$tagger);
			mysql_query("UPDATE $t SET count='$count',tagger='$tagger' WHERE name='$name'");
			echo "Your tag has been deleted";
		}
		else{
			mysql_query("DELETE FROM $t WHERE name='$name'");
			echo "Your tag has been deleted";
		}
	}

	else echo "Seems like you haven't tagged this picture, Confused?";

?>
