<?php
require("header.php");
$verifystring=urlencode($_GET['verify']);
$verifyemail=urlencode($_GET['email']);
$sql="SELECT id FROM users WHERE verifystring = '" . $verifystring . "' AND email = '" . $verifyemail . "';";
$result=mysql_query($sql);
$numrows=mysql_num_rows($result);
if($numrows==1){
	$row=mysql_fetch_assoc($result);
	$sql="UPDATE users SET active = 1 WHERE id = " . $row['id'];
	$result=mysql_query($sql);
	echo "Your account has now been verified. You can now <a href='login.php'>Log in</a>";
}
else{
	"this account could not be verified.";
}
require("footer.php");
?>