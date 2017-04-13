<?php
session_start();
require("db.php");
require("functions.php");
if(isset($_SESSION['SESS_ADMINUSER'])==TRUE){
	$auth=1;
}
if(isset($_SESSION['SESS_USERNAME'])==TRUE){
	$authsql = "SELECT * FROM subjects WHERE owner_id = " . $_SESSION['SESS_USERID'] . " ORDER BY subject ASC;";
	$authresult = mysql_query($authsql);
	$authnumrows = mysql_num_rows($authresult);
	if($authnumrows>=1){
		$auth =1 ; 
	}
}
if($auth!=1){
	header("Location: " . $config_basedir);
}
if(isset($_POST['submit'])){
	$sql = "INSERT INTO topics(subject_id, name) VALUES(" . "'" . $_POST['subject'] . "', '" . pf_fix_slashes($_POST['topic']) . "');";
	mysql_query($sql);
	header("Location: " . $config_basedir . "index.php?subject=" . $_POST['subject']);
}else{
	require("header.php");

?>
<h1>Add a new topic</h1>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
<table cellpadding="5">
	<tr>
		<td>Subject</td>
		<td>
			<?php
			if(isset($_SESSION['SESS_ADMINUSER'])){
				$sql = "SELECT * FROM subjects ORDER BY subject ASC;";
				$result = mysql_query($sql);
			}
			else{
				$sql = "SELECT * FROM subjects WHERE owner_id = " . $_SESSION['SESS_USERID'] . " ORDER BY subject ASC;";
				$result = mysql_query($sql);
			}
			echo "<select name='subject'>";
			while($row = mysql_fetch_assoc($result)){
				echo "<option value = '" . $row['id'] . "'>" . $row['subject'] . "</option>";
			}
			echo "</select>";
			?>
		</td>
	</tr>
	<tr>
		<td>Topic</td>
		<td><input type="text" name="topic"></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit"></td>
	</tr>
</table>
</form>
<?php
}
require("footer.php");
?>