<?php
	if(session_id() == '')
	session_start();
	require("config.php");
	$db=mysql_connect($dbhost, $dbuser, $dbpassword);
	mysql_select_db($dbdatabase, $db);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	"http://www.w3.org/TR/html4/loose.dtd"> 
	<html>
	<head>
		<title>BidTastic</title>
		<link rel="stylesheet" href="stylesheet.css" type="text/css" />
	</head>
	<body>
		<div class="blur">
		</div>
		<div id="header">
		<h1>BidTastic Auctions</h1>
		</div>
		<div id="menu">
		<a href="index.php">Home</a>
		<?php
			if(isset($_SESSION['USERNAME'])==TRUE){
				echo "<a href='logout.php'>Logout</a>";
			}
			else{
				echo "<a href='login.php'>Login</a>";
			}
		?>
	<a href="newitem.php">New item</a>
	</div>
	<div id="container">
	<div id="bar">
	<?php 
	$catresult = mysql_query('SELECT * FROM categories ORDER BY cat ASC');
	echo mysql_error();
	echo "<ul>";
	echo "<h1>Categories</h1>"; 
	echo "<li><a href='index.php'>View All</a></li>"; 
	while($catrow = mysql_fetch_assoc($catresult)) { 
		echo "<li><a href='index.php?id=" . $catrow['id'] . "'>" . $catrow['cat'] . "</a></li>"; 
	}	
	echo "</ul>";
	?>
	</div>
	<div id="main">
	</body>
