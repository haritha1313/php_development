<?php
session_start();
require("config.php");

if(isset($_SESSION['SESS_USERNAME'])){
	header("Location: " . $config_basedir . "userhome.php");
}

$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if(isset($_POST['submit'])){
	$sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
	$result = mysql_query($sql);
	$numrows = mysql_num_rows($result);

	if($numrows == 1){
		$row = mysql_fetch_assoc($result);
		$_SESSION['SESS_USERNAME'] = $_POST['username'];
		$_SESSION['SESS_USERID'] = $row['id'];
		header("Location: " . $config_basedir . "userhome.php");

	}else{
		header("Location: " . $config_basedir . "/login.php?error=1");
	}
}else{
	require("header.php");
	if(isset($_GET['error']))
	{
		echo "Incorrect login, please try again!";
	}
?>
	<h1>Login</h1>
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
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
		<td> <input type="submit" name="submit" value="Login!"></td>
		</tr>
	</table>
	</form>

<?php
}
require("footer.php");
?>