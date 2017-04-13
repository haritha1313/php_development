<?php
session_start();
require("db.php");
require("functions.php");

if(pf_check_number($_GET['id']) == TRUE){
	$validid=$_GET['id'];
}else{
	header("Location: " . $config_basedir);
}
echo "hi";
if(isset($_POST['submit'])){
	echo "submitted";
	$qsql="INSERT INTO comments(question_id, title, comment, user_id) VALUES('" . $validid . "','" . pf_fix_slashes($_POST['titleBox']) . "','" . pf_fix_slashes($_POST['commentBox']) . "', '" . $_SESSION['SESS_USERID'] . "')";

		mysql_query($qsql);
		echo mysql_error();
		header("Location: " . $config_basedir . "answer.php?id=" . $validid);
}else{
	require("header.php");
	$qsql = "SELECT questions.question, questions.dateadded, questions.answer, users.username FROM questions, users WHERE questions.addedby_id = users.id AND questions.id = " . $validid . " AND active = 1;";
	$qresult=mysql_query($qsql);
	echo mysql_error();
	$qrow=mysql_fetch_assoc($qresult);

	if(mysql_num_rows($qresult)==0){
		echo "No questions";
	}else{
		echo "<h1>" . $qrow['question'] . "</h1>";
		echo "Added by <strong>" . $qrow['username'] . "</strong> on " . date("D jS F Y g.iA", strtotime($qrow['dateadded']));
		echo "<p>";
		echo $qrow['answer'];
		echo "</p>";

		$csql="SELECT comments.title_id, comments.comment, users.username FROM comments, users WHERE comments.user_id=users.id AND comments.question_id = " . $validid . " ;";
		$cresult=mysql_query($csql);
		echo "<table class='visible' width='68%' cellspacing=0 align='right' cellpadding=5>";
		echo "<tr><th class='visible' colspan=2>Comments about this question</th></tr>";
		if(mysql_num_rows($cresult)==0){
			echo "<tr ><td colspan=2><strong>No comments!</strong></td></tr>";
		}
		else{
			while($crow=mysql_fetch_assoc($cresult)){
				echo "<tr>";
				echo "<td width='15%'><strong>" . $crow['title_id'] . "</strong> by <i>" . $crow['username'] . "</i></td>";
				echo "<td>" . $crow['comment'] . "</td>";
				echo "</tr>";
			}
		}
	echo "</table>";
	if(isset($_SESSION['SESS_USERNAME'])) { echo "<h2>Add a comment</h2>"; echo "<form action='answer.php?id=" . $_GET['id'] . "' method='POST'>"; echo "<table width='100%'>"; echo "<tr>"; echo "<td>Title</td>"; echo "<td><input type='text' name='titleBox'></td>"; echo "</tr>"; echo "<tr>"; echo "<td>Comment</td>"; echo "<td><textarea rows=10 cols=50 name='commentBox'></textarea></td>"; echo "</tr>"; echo "<tr>"; echo "<td></td>"; echo "<td><input type='submit' name='submit'value='Post Comment'></td>"; echo "</tr>"; echo "</table>"; echo "</form>"; }
else{
		echo "<p>&bull; You cannot post as you are <strong>Anonymus</strong>. Please <a href='login.php'>login</a></p>";
	}
	}
}
require("footer.php");
?>