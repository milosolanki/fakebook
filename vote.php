<?php
$photo=$_POST['photo'];
$category=$_POST['category'];
$email=$_COOKIE['email'];

include "mysql_connect.php";

mysql_select_db("fakebook",$conn);
$result = mysql_query("select * from photos where name='$photo'") or die(mysql_error());
$row = mysql_fetch_array($result);
$count = $row[$category] + 1;
$result=mysql_num_rows(mysql_query("select * from vote where name='$photo' and people like '%$email%'"));
if ($result==0){
mysql_query("UPDATE photos set $category='$count' where name='$photo'") or die(mysql_error());
mysql_query("UPDATE vote set people=CONCAT('$email,',people) where name ='$photo'");
header("Location: index.php");exit;
}
else {echo "<script>alert('You have already voted this picture');</script>";}
mysql_close($conn);
?>