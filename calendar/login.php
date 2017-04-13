<?php
session_start();
require("config.php");
$db=mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if(isset($_SESSION['LOGGEDIN'])==TRUE){
	header("Location: " . $config_basedir . "view.php");

}
if(isset($_POST['submit'])){
	$loginsql= "SELECT * FROM users WHERE username = '" . $_POST['userBox'] . "' AND password = '" . $_POST['passBox'] . "'";
	$loginres=mysql_query($loginsql);
	$numrows=mysql_num_rows($loginres);
	echo mysql_error();
	echo $numrows;
	if($numrows==1){
		$loginrow = mysql_fetch_assoc($loginres);
		$_SESSION['LOGGEDIN'] = 1;
		header("Location: " . $config_basedir . "view.php");
	}else{
		header("Location: " . $_SERVER['SCRIPT_NAME'] . "?error=1");
	}
}else{
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> <html>
	 <head> 
	 <title></title> 
	 <link href="stylesheet.css" rel="stylesheet"> </head> 
	 <body> <div id="login">
<h1>Calendar Login</h1> 
Please enter your username and password to log on. <p>
<?php if(isset($_GET['error'])){
	echo "<strong>Incorrect username/password</strong>";

}?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
<table>
	<tr>
		<td>Username</td>
		<td><input type="text" name="userBox"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="passBox"></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Log In"></td></tr>
</table>
</form>
</div>
<?php
}
?>
