<?php

	$allowedExts = array("gif", "jpeg", "jpg", "JPG", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/png"))
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/JPG")
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
	  {
	if ($_FILES["file"]["error"] > 0)
	{	
	    echo "Error---Return Code: " . $_FILES["file"]["error"] . "<br>";
	}
  	else
  	{
                if (file_exists("upload/".$_FILES["file"]["name"]))
      		{
      			echo $_FILES["file"]["name"] . " already exists.Rename and try again ";exit;
      		}
        	else
      		{
      			move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
      			echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      		}
    	}
  }
	else
  {
  echo "Image type not allowed, rename the file and try again.";exit;
  }

	$name=$_FILES['file']['name'];
	$uploader=$_COOKIE['username'];
	$email = $_COOKIE['email'];
	$category=$_POST['category'];
	$date=date('d-M-Y');
        $time = date('g:i:s A');
	
	include "mysql_connect.php";
	
	mysql_select_db("fakebook",$conn);
	$result = mysql_query("select * from photos where name='$name'") or die(mysql_error());
	$row = mysql_fetch_array($result);
	if($name==$row['user'])
	{
		echo "<script>alert('Filename  already exists, please rename and try.');</script>";exit;
	}
	else
	{
		mysql_query("INSERT INTO photos(id,name,uploader,date,time,human,bird,animal,building,vehicle,object,ufo) values('','$name','$email','$date','$time','0','0','0','0','0','0','0')");
		$t = mysql_insert_id();
		mysql_query("UPDATE photos set $category=1 where name='$name'");
		mysql_query("INSERT INTO vote(name,people) values('$name','$email')");
		$name="t".$t;
		echo $name;
		mysql_query("CREATE TABLE IF NOT EXISTS $name(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,name VARCHAR(255),count VARCHAR(10),tagger VARCHAR(5000),topi VARCHAR(5),lefti VARCHAR(5))") or die (mysql_error());
		header('Location: index.php');
		exit;
	}
mysql_close($conn);	
?>
