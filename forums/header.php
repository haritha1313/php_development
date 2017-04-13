<?php
require("config.php");
if(session_id() == '') {
    session_start();
}
$db=mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_select_db($dbdatabase,$db);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
<title>
<?php echo $config_forumsname; ?> </title>
<link rel="stylesheet" href="Stylesheet.css" type="text/css" />
</head>
<body>
<div id="header">
<h1><?php echo $config_forumsname; ?> </h1>
<div id="banner">
[<a href="index.php">Home</a>]
<?php if(isset($_SESSION['USERNAME'])){
	echo "[<a href='logout.php'>Logout</a>]";
} else{
	echo "[<a href='login.php'>Login</a>]";
	echo "[<a href='register.php'>Register</a>]";
}
?>
[<a href="newtopic.php">New Topic</a>]
</div>
</div>
<div id="main"><br><br>
