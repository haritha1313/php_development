<?php
session_start();

if(isset($_SESSION['SESS_ADMINUSER'])==FALSE){
	header("Location: " . $config_basedir);
}
require("db.php");
require("functions.php");

function set_validid(){
	if(pf_check_number($_GET['id'])==TRUE){
		return $_GET['id'];
	}else{
		header("Location: " . $config_basedir);
	}
}
if(isset($_GET['func'])){
switch ($_GET['func']) {
	case 'main':
		require("header.php");

		$subssql = "SELECT subjects.subject, subjects.id FROM subjects INNER JOIN mod_subowner ON subjects.id = mod_subowner.sub_id GROUP BY subjects.id;";
		$subsresult = mysql_query($subssql);
		$subsnumrows = mysql_num_rows($subsresult);
		echo "<h1>Subjects and Ownership</h1>";
		if($subnumrows == 0){
			echo "<No requests have been made.";
		}else{
			while($subsrow=mysql_fetch_assoc($subsresult)){
				$reqsql = "SELECT users.id AS userid, users.username, mod_subowner.* FROM users INNER JOIN mod_subowner ON mod_subowner.user_id = users.id WHERE mod_subowner.sub_id = " . $subsrow['id'] . ";";
				$reqresult = mysql_query($reqsql);

				echo "<table class='visible' cellpadding=10 cellspacing=0>";
				echo "<tr><th class='visible' colspan='4'>Ownership requests for <i>" . $subsrow['subject'] . "</i></th></tr>";
				while($reqrow=mysql_fetch_assoc($reqresult)){
					echo "<tr>";
					echo "<td>Requested by <strong>" . $reqrow['username'] . "</strong></td>";
					echo "<td>" . $reqrow['reasons'] . "</td>";
					echo "<td><a href='" . $_SERVER['SCRIPT_NAME'] . "?func=accept&id=" . $reqrow['id'] . "'>Accept</a></td>";
					echo "<td><a href='" . $_SERVER['SCRIPT_NAME'] . "?func=deny&id=" . $reqrow['id'] . "'>Deny</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "<br/>";
			}
		}
		break;
		case "accept":
		$validid = set_validid();
		$sql = "SELECT mod_subowner.sub_id, subjects.subject, users.id AS userid, users.username, users.email FROM mod_subowner INNER JOIN subjects ON mod_subowner.user_id = users.id WHERE mod_subowner.id = " . $validid . ";";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		$numrows = mysql_num_rows($result);

		$mail_username = $row['username'];
		$mail_email = $row['email'];
		$mail_subject = $row['subject'];

$mail_body=<<<_MESSAGE_
Hi $mail_username,
I am pleased to inform you that you have been accepted as the new owner of the '$mail_subject' subject.
When you next lof into '$config_sitename' you will see the subject in your control panel.

Kind regards,
$config_sitename Administrator
_MESSAGE_;	
		mail($mail_email, "Ownership request for " . $mail_subject)
	default:
		# code...
		break;
}}else{
		header("Location: " . $config_basedir);
}