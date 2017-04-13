<?php
session_start();
require("config.php");
$db=mysql_connect($dbhost,$dbuser,$dbpassword);
mysql_select_db($dbdatabase,$db);
if(isset($_SESSION['USERNAME'])==FALSE){
	header("Location: " . $config_basedir);
	exit();
}#testing stuff
if(isset($_POST['submit'])){
	$sql="INSERT INTO entries(cat_id, dateposted, subject, body) VALUES(" . $_POST['cat'] . ", NOW(), '" . $_POST['subject'] . "', '" . $_POST['body'] . "');";
	mysql_query($sql);
	header("Location: " . $config_basedir);	
}
else{
	require("header.php");
	?>
<h1>Add new entry</h1>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
<table>
<tr>
<td>Category</td>
<td>
<select name="cat">
<?php
$catsql="SELECT * FROM categories;";
$catres=mysql_query($catsql);
while($catrow=mysql_fetch_assoc($catres)){
	echo "<option value='" . $catrow['id'] . "'>" . $catrow['cat'] . "</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>Subject</td>
<td><input type="text" name="subject"></td>
</tr>
<tr>
<td>Body</td>
<td><textarea name="body" rows="10" cols="50"></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Add entry!"> </td>
</tr>
</table>
</form>
<?php
}
require("footer.php");
?>