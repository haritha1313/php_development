<?php
session_start();
require("config.php");
$db=mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if(isset($_SESSION['LOGGEDIN']) == FALSE){
	header("Location: " . $config_basedir);
}
if($_GET['action'] == 'getevent'){
	$sql = "SELECT * FROM events WHERE id = " . $_GET['id'] . ";";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

	echo "<h1>Event details</h1>";
	echo $row['name'];
	echo "<p>" . $row['description'] . "</p>";
	echo "<p><strong>Date:</strong> " . date("D jS F Y", strtotime($row['date'])) . "<br/>";
	echo "<strong>Time:</strong> " . $row['starttime'] . "-" . $row['endtime'] . "</p>";
}

?>