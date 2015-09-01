<?php	
	
	setcookie("username",$user,time()-3600);
        setcookie("email",$mail,time()-3600);
        setcookie("id",$id,time()-3600);
        header('Location: index.php');
	exit;

?>
