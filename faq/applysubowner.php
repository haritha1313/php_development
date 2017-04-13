<?php
session_start();
require("db.php");
require("functions.php");
if(pf_check_number($_GET['subject'])==TRUE){
	$validsubject = $_GET['subject'];
}else{
	header("Location: " . $config_basedir);
}
header("header.php");
if(isset($_POST['submit'])){
	$appsql = "SELECT * FROM mod_subowner WHERE sub_id = " . $validsubject . " AND user_id = '" . $_SESSION['SESS_USERID'] . "';";
	$appresult = mysql_query($appsql);

	if(mysql_num_rows($appresult)==0){
		$inssql = "INSERT INTO mod_subowner(sub_id, user_id, reasons) VALUES(" . $_GET['subject'] . "," . $_SESSION['SESS_USERID'] . ",'" . pf_fix_slashes($_POST['reasons']) . "');";
		mysql_query($inssql);
		echo "<h1>Application Submitted</h1>";
		echo "Your application has been submitted. You will be emailed with the decision.";
		echo "<a href='index.php'>Home</a>";
	}
	else{
		echo "<h1>Already applied</h1>";
		echo "<p>You have already made an application for this subject.</p>";
		echo "<a href='index.php'>Home</a>";
	}
}else{
$subsql = "SELECT subject FROM subjects WHERE id = " . $validsubject . ";";
$subresult = mysql_query($subsql);
echo mysql_error();
$subrow = mysql_fetch_array($subresult);
?>
<h1>Application for ownership of <i><?php echo $subrow['subject']; ?></i></h1>
<p>You have applied to maintain the subject <strong><?php echo $subrow['subject']; ?></strong>.</p>
<p>
The procedure to apply to own a subject is as follows:
<ul>
<li>Fill in this subject ownership application form.</li>
<li>The contents of this form will be submitted to the site administrator approval.</li>
<li>You will be notified in your account homepage of the administrator's decision.</li>
</ul>
</p>
<p>
When you fill out the Reasons box, it is advised that you indicate why you should be given the ownership of the subject. What can you bring to the subject in terms of time and knowledge? Can you ensure the subject questions and clear and well structured?</p> 
<form action="applysubowner.php?subject=<?php echo $validsubject; ?>" method="POST">
<table cellpadding="5" cellspacing="5">
	<tr>
		<td>Reasons</td>
		<td><textarea name="reasons" cols="50" rows="10"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Apply!"></td>
	</tr>
</table>
</form>
<?php
}
require("footer.php");
?>