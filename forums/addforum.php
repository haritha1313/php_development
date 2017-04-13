<h2>Add a new forum</h2>
<form action="<?php echo pf_script_with_get($_SESSION['SCRIPT_NAME']); ?>" method="post"> 
<table> <?php
if($validforum == 0) 
	{
	 $forumssql = "SELECT * FROM categories ORDER BY name;"; 
	 $forumsresult = mysql_query($forumssql); 
	 ?> 
	 <tr> 
	 	<td>Forum</td> 
	 <td><select name="cat"> 
	 <?php 
	 while($forumsrow = mysql_fetch_assoc($forumsresult)) 
	 	{ echo "<option value='" . $forumsrow['id'] . "'>" . $forumsrow['name'] . "</option>"; } 
	 ?>
	 </select></td> 
	 </tr>
	 <?php 
	 } 
	 ?>
	 <tr> 
	 <td>Name</td> 
	 <td><input type="text" name="name"></td> 
	 </tr> 
	 <tr> 
	 <td>Description</td> 
	 <td><textarea name="description" rows="10" cols="50"></textarea></td> 
	 </tr> 
	 <tr> 
	 <td></td> 
	 <td><input type="submit" name="submit" value="Add Forum!"></td> 
	 </tr> 
	 </table> 
	 </form>
