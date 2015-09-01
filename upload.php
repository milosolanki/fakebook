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
        mysql_close($conn);
        if ($username!== $user){header("Location: login.html");exit;}
        else if ($email!==$mail) {header("Location: login.html");exit;}
        else if ($pass!== $id) {header("Location: login.html");exit;}

    
?>
<!DOCTYPE html>
<html>
<head>
<title>Upload Photo | Fakebook</title>
<script src="validate.js"></script>
<link rel='stylesheet' href="indexstyle.css" />
</head>
<body>
<?php include "header.php"; ?>

<br><br><br>
<form enctype="multipart/form-data" name='upload' id='upload' style='padding:60px;' onsubmit='return validateimage(this);' method='post' action='upload1.php'>
<fieldset style="border-radius:25px;width:500px;">
<p>Select a file:&nbsp;&nbsp;
<input type='file' name='file' id='file' accept='image/*' />
</p>
<p>Select a category for the photo:&nbsp;&nbsp;
<select name='category'>
<option selected value="human"> Human </option>
<option value="bird"> Bird </option>
<option value="animal"> Animal </option>
<option value="building"> Building </option>
<option value="vehicle"> Vehicle </option>
<option value="object"> Object </option>
<option value="ufo"> UFO </option>
</select>
</p>
<p style='position:relative;padding-left:60px;'><input type='submit' value='Upload'></p>
</fieldset>
</form>
</body>
</html>
