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
<title>Tag Photo | Fakebook</title>
<link rel='stylesheet' href='homestyle.css' />
<link rel='stylesheet' href='indexstyle.css' />
<script src='jquery.js'></script>
<script src='index.js'></script>
<script type='text/javascript'>
	function tag(event){
	var elements = document.getElementsByClassName("tagged");
	var names = '';
	if(event=='show')
	for(var i=0; i<elements.length; i++) {
    	elements[i].style.opacity='1';
		}
	if(event=='hide')
	for(var i=0; i<elements.length; i++) {
        elements[i].style.opacity='0';
	elements[i].onhover="this.style.opacity='1'";
	
                }
	}
</script>
</head>
<body>

<?php include 'header.php' ?>
<?php
	$name2 = $_GET['pic'];
	include "mysql_connect.php";
	mysql_select_db("fakebook");
	$name1 = mysql_query("SELECT * FROM photos WHERE id='$name2'");
	if (mysql_num_rows($name1)< 1) header("Location: show_404.php");
	$name2 = "t".$name2;
	$name1 = mysql_fetch_array($name1);
	$date = $name1['date'];
	$time = $name1['time'];
	$name3 = $name1['uploader'];
	$result = mysql_query("SELECT * FROM USER WHERE mail='$name3'") or die(mysql_error());
	$row = mysql_fetch_array($result) or die(mysql_error());
	$uploadedby = $row['user'];
	$name1 = $name1['name'];
	$max = 0; $maxtag='';
	echo "<div id='uploader' style='position:absolute;top:110px;left:350px;'>".$uploadedby." uploaded this photo on ".$date." at ".$time.".</div>";
	$query=mysql_query("SELECT * from $name2");
	echo "<div style='position:absolute;left:370px;top:150px;'><img src='upload/$name1' id='image' width=500 height=400/></div>";
	$tagcounts = "Tag counts:<br>";
	while($run = mysql_fetch_array($query)){
	$name =  $run['name'];
	$top  =$run['topi'];
	$left = $run['lefti'];
	if ($run['count']>=$max){
		$max=$run['count'];$maxtag=$run['name'];
	}
	$tagcounts=$tagcounts."&nbsp;&nbsp;".$run['name']." - ".$run['count']."<br>";
echo "<div  class='tagged' title='Tagged by ".$run['tagger']."' style='position:absolute;top:".$top."px;left:".$left."px;'>".$name."</div>";
	}
?>
<br>
<div style='position:absolute;top:560px;left:370px'><span id='tag'><?php if ($max>0) echo "Current Name: $maxtag, tagged by $max people."; else echo "No tags :(."; ?></span>&nbsp;&nbsp;<span id='del' style='color:blue;cursor:pointer;text-decoration:underline'>Delete my tag</span></div>
<div id='tagcount' style="position:absolute;left:930px;top:200px;"><?php echo $tagcounts; ?></div>
<input id='name' list='tags' type='text'/>
<?php
	$query=mysql_query("SELECT * from $name2");
        echo "<datalist id='tags'>";
        while($run = mysql_fetch_array($query)){
        $name =  $run['name'];
echo "<option value='$name'>";
        }
echo "</datalist>";
?>
<input type='hidden' id='table' value='<?php echo $name2;?>'/>
<button style='position:absolute;left:130px;top:230px;' onclick="tag('show');">Show all tags</button>
<button style='position:absolute;left:130px;top:280px;' onclick="tag('hide');">Hide all tags</button>
<button style='position:absolute;left:130px;top:330px;' onclick="window.close();">Close Window</button>
</body>
</html>
