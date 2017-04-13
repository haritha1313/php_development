<?php
session_start();
require("config.php");
if(isset($_SESSION['SESS_USERNAME'])==FALSE){
	header("Location: " . $config_basedir . "login.php");
}
require("header.php");

echo "<h1>Control panel</h1>";
echo "Welcome <strong> [<a href='userlogout.php'>Logout</a>]";

echo "<h2>Subjects Owned</h2>";
$ownsql = "SELECT * FROM subjects WHERE owner_id =" . $_SESSION['SESS_USERID'] . ";";
$ownres = mysql_query($ownsql);
if(mysql_num_rows($ownres) >= 1){
	echo "<ul>";
	while($ownrow = mysql_fetch_assoc($ownres)){
		echo "		&bull;<strong><a href='index.php?subject=" . $ownrow['id'] . "'>" . $ownrow['subject'] . "</a></strong>";
		echo "-";
		echo "<a href='addquestion.php?subject=" . $ownrow['id'] . "'>Add a question</a>";
		echo "&bull;";
		echo "<a href='removesubown.php?subject=" . $ownrow['id'] . "'>Remove ownership</a>";
		
	}
	echo "</ul>";
	echo "<br/>";
	echo "<i><a href='addtopic.php'>Add a topic</a></i>";
	echo "&bull;";
	echo "<i><a href='adminmodquestions.php?func=main'>Moderate submitted questions</a></i>";
}else{
	echo "No subjects are owned";
}
require("footer.php");
?>