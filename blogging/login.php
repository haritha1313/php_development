<?php
require("config.php");
session_start();
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
 mysql_select_db($dbdatabase, $db);
if(isset($_POST['submit'])) {
	
	$sql = "SELECT * FROM logins WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
$result = mysql_query($sql); 
$numrows = mysql_num_rows($result);
if($numrows == 1) {
 $row = mysql_fetch_assoc($result);
$_SESSION['USERNAME'] = $row['username']; 
$_SESSION['USERID'] = $row['id'];
session_regenerate_id(true);
header("Location: " . $config_basedir);
exit();
} else {
 header("Location: " . $config_basedir . "/login.php?error=1");
 exit(); }
} else {
require("header.php");
?>
<h3>Login</h3>
	<form action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post"> 
	
	<table>
		<tr>
		<td>Username</td>
		<td><input type="text" name="username"></td>
		</tr>
		<tr>
		<td>Password</td>
		<td><input type="password" name="password"></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Login"></td>
		</tr>
	</table>
	
	</form>
<?php
}
require("footer.php");
?>