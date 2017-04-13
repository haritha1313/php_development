<?php
session_start();
require("config.php");
require("functions.php");

$db=mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);

if(isset($_POST['submit'])){
	$sql="SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
	$result=mysql_query($sql);
	$numrows=mysql_num_rows($result);
	if($numrows==1){
		$row=mysql_fetch_assoc($result);
		if($row['active']==1){
			$_SESSION['USERNAME']=$row['username'];
			$_SESSION['USERID']=$row['id'];
			if(isset($_GET['ref'])){
				switch($_GET['ref']){
					case "addbid":header("Location: " . $config_basedir . "itemdetails.php?id=" . $_GET['id'] . "#bidbox");
					break;
					case "newitem":header("Location: " . $config_basedir . "newitem.php");
					break;
					case "images":header("Location: " . $config_basedir . "addimages.php?id=" . $_GET['id']);
					break;
					default:header("Location: " . $config_basedir);
					break;
			}
			}else{
				header(("Location: " . $config_basedir));
			}
		}else{
			require("header.php");
			echo "Not verified yet";
		}
	}
	else{
		header("Location: " . $config_basedir . "login.php?error=1");
	}
}else{
	require("header.php");
	echo "<h1>Login</h1>";
	if(isset($_GET['error']))
		if($_GET['error']){
			echo "Incorrect login, please try again";
		}
?>
<form action="<?php echo pf_script_with_get($_SERVER['SCRIPT_NAME']); ?>" method="POST">
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
	<td><input type="submit" name="submit" value="Login!"></td> 
	</tr> 
	</table> 
	</form> Don’t have an account? Go and <a href="register.php">Register</a>! 
<?php 
	} 
	require("footer.php"); 
?>

</table>