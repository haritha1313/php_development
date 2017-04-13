<?php
require("config.php");
if(session_id() == '') {
    session_start();
}
$db = mysql_connect($dbhost, $dbuser, $dbpassword); 
mysql_select_db($dbdatabase,$db);
?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>
	<?php echo $config_blogname;?>
</title>
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>
<div id="header">
<h1><?php echo $config_blogname;?></h1>
<div id="banner"><a href="index.php">home</a>
<a href='viewcat.php?id=FALSE'>categories</a>
<?php
if(isset($_SESSION['USERNAME'])){
	
echo "<a href='logout.php'>logout</a>";
echo "-";
echo "<a href='addentry.php'> Add entry </a>";
echo "<a href='addcat.php'> Add Category </a>";
echo "</div>";}
else {
		echo "<a href='login.php'>login</a></div>";
	}	
?>
</div>
<div id="main">