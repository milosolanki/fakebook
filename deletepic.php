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
<title>Delete this Photo | Fakebook</title>
<link rel='stylesheet' href='homestyle.css' />
<link rel='stylesheet' href='indexstyle.css' />
<script src='jquery.js'></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#confirm-delete").slideDown();
		$("#delete-pic-yes").click(function(){
			var pic_id = $('#pic_id').val();
			var pic_uploader = $('#pic_uploader').val();
			$.post('deletepicconfirm.php', { pic_id:pic_id , pic_uploader:pic_uploader }, function(data){
			alert(data);
			window.location.assign("index.php");
			});
		});
		$("#delete-pic-no").click(function(){
			window.close();
		});
		
	});
</script>

</head>
<body>

<?php include 'header.php' ?>
<?php
	$name2 = $_GET['pic'];
	$pic_id = $name2;
	include "mysql_connect.php";
	mysql_select_db("fakebook");
	$name1 = mysql_query("SELECT * FROM photos WHERE id='$name2'");
	
	if (mysql_num_rows($name1)< 1) header("Location: show_404.php");
	$name2 = "t".$name2;
	$name1 = mysql_fetch_array($name1);
	$date = $name1['date'];
	$time = $name1['time'];
	$name3 = $name1['uploader'];
	if ($name3 !== $mail) {
		echo "<script>$(document).ready() = function(){alert(\"You are on a wrong page.\nYou aren't authorised to delete this photo.\");window.close();}</script>";
	} 
	$result = mysql_query("SELECT * FROM USER WHERE mail='$name3'") or die(mysql_error());
	$row = mysql_fetch_array($result) or die(mysql_error());
	$uploadedby = $row['user'];
	$name1 = $name1['name'];
	$max = 0; $maxtag='';
	echo "<div id='uploader' style='position:absolute;top:110px;left:440px;'>".$uploadedby." uploaded this photo on ".$date." at ".$time.".</div>";
	$query=mysql_query("SELECT * from $name2");
	echo "<div style='position:absolute;left:460px;top:150px;'><img src='upload/$name1' id='image' width=500 height=400/></div>";
	$tagcounts = "Tag counts:<br>";
	while($run = mysql_fetch_array($query)){
	$name =  $run['name'];
	$top  =$run['topi'];
	$left = $run['lefti'];
	if ($run['count']>=$max){
		$max=$run['count'];$maxtag=$run['name'];
	}
	$tagcounts=$tagcounts."&nbsp;&nbsp;".$run['name']." - ".$run['count']."<br>";
	}
?>
<br>
<div style='position:absolute;top:560px;left:460px'><span id='tag'><?php if ($max>0) echo "Current Name: $maxtag, tagged by $max people."; else echo "No tags :(."; ?></span>
</div>
<div id='tagcount' style="position:absolute;left:1000px;top:200px;"><?php echo $tagcounts; ?></div>
<div id="confirm-delete" style="display: none;position:absolute;top: 250px; left: 30px;">Are you sure you want to delete this pic?<br><br><span class="bttn_b" id="delete-pic-yes" style="margin-left:30%;">Yes</span><span class="bttn_b" id="delete-pic-no">No</span></div>

<input type="hidden" id="pic_id" name="pic_id" value="<?php echo $pic_id ?>" />
<input type="hidden" id="pic_uploader" name="pic_uploader" value="<?php echo $name3 ?>" />
</body>
</html>
