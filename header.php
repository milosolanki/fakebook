<div id='heading' style='position:fixed;top:0px;left:0px;right:0px;padding:10px;color:white;height:60px;width:100%;background-color:#3b5999;height:30px;z-index: 10;border-bottom: 3px inset #3b5999;'>
<span id='logo' title='Fakebook Home' style='font-family:georgia;font-size:22px;position:absolute;left:50px;'>
<a href='index.php'>fakebook</a>
</span>
<span id='top-head-links' style='position:absolute;left:900px;font-size:14px;top:20px;'>
<a href="index.php" title="Home">Home</a> <span style="color:red;">|</span> <a title="Your profile" href="timeline.php?user=<?php echo $_COOKIE['email']; ?>"><?php echo $_COOKIE['username']; ?></a> <span style="color:red;">|</span> <a title="LogOut" href='logout.php'>Sign Out</a>
</span>
</div>

