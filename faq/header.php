<?php
require("config.php");

$db=mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Translational//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $config_sitename; ?></title>
	<link href="stylesheet.css" rel="stylesheet">
</head>
<body>
	<div id="header">
		<?php echo "<h1>" . $config_sitename . "</h1>"; ?>
	</div>

	<div id="menu">
	&bull;
	<a href="index.php">Home</a>
	&bull;
	<?php if(isset($_SESSION['SESS_USERNAME'])){
		echo "<a href='userlogout.php'>Logout</a>";
	}
	else{
		echo "<a href='login.php'>Login</a>";
	}
	?>
	&bull;
	</div>
	<div id="container">
	<div id="bar">
	<?php
	require("bar.php");
	?>
	</div>
	<div id="main">
