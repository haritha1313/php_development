<?php
session_start();
require("config.php");
require("functions.php");
if(isset($_SESSION['ADMIN'])==FALSE)
	header("Location: " . $config_basedir . "/admin.php?ref=cat");
if(isset($_POST['submit'])){
	$db=mysql_connect($dbhost, $dbuser, $dbpassword);
	mysql_select_db($dbdatabase, $db);

	$catsql= "INSERT INTO categories(name) VALUES('" . $_POST['cat'] . "');";
	mysql_query($catsql);
	header("Location: " . $config_basedir);
}
else{
	require("header.php");


?>
<h2>Add a new category</h2>
<form action="<?php echo pf_script_with_get($_SERVER['SCRIPT_NAME']); ?>" method="POST">
<table>
	<tr>
	<td>Category</td>
	<td><input type="text" name="cat"></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Add Category"></td>
	</tr>
</table>
</form>
<?php
}
require("footer.php");
?>
