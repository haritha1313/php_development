<?php
require("config.php");
if(($_GET['id'])==TRUE){
	if(is_numeric($_GET['id'])==FALSE)
		header("Location: " . $config_basedir);
	else
		$validtopic=$_GET['id'];}
	else
		header("Location: " . $config_basedir);

	require("header.php");
	$topicsql="SELECT topics.subject, topics.forum_id, forums.name FROM topics, forums WHERE topics.forum_id=forums.id AND topics.id= " . $validtopic . ";";
	$topicresult=mysql_query($topicsql);
	$topicrow=mysql_fetch_assoc($topicresult);
	echo "<h2>" . $topicrow['subject'] . "</h2>";
	echo "<a href='indec.php'>" . $config_forumsname . "</a> -> <a href= 'viewforum.php'?id=" . $topicrow['forum_id'] . "'>" . $topicrow['name'] . "</a><br><br>";

	$threadsql = "SELECT messages.*, users.username FROM messages, users WHERE messages.user_id = users.id AND messages.topic_id = " . $validtopic . " ORDER BY messages.date;";
	$threadresult=mysql_query($threadsql);
	echo "<table>";
	while($threadrow=mysql_fetch_assoc($threadresult)){
		echo "<tr><td><strong>Posted by <i>" . $threadrow['username'] . "</i> on " . date("D jS F Y g.iA", strtotime($threadrow['date'])) . " - <i>" . $threadrow['subject'] . "</i></strong></td></tr>";
		echo "<tr><td>" . $threadrow['body'] . "</td></tr>";
		echo "<tr></tr>";
	}
	echo "<tr><td>[<a href='reply.php?id=" . $validtopic . "'>reply</a>]</td></tr>";
	echo "</table>";
	require("footer.php");
	?>