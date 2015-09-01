<?php
$conn = mysql_connect("localhost","root","12345");
if(!$conn){
	die('Could not connect to server: ' .mysql_error());
}
