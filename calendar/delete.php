<?php
require("config.php");

$db=mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

$sql= "DELETE FROM events WHERE id = " . $_GET['id'];
mysql_query($sql);

echo "<script>javascript: history.go(-1)</script>";
?>