<?php
	require("config.php");
	require("functions.php");
	if(isset($_GET['id']))
	$validid = pf_validate_number($_GET['id'], "value", $config_basedir);
	else
		$validid=0;
	require("header.php");
	if($validid==0){
		$sql="SELECT items.* FROM items WHERE dataends > NOW()";
	}
	else{
		$sql="SELECT * FROM items WHERE dataends > NOW() AND cat_id = " . $validid . ";";
	}
	$result = mysql_query($sql);
	$numrows = mysql_num_rows($result);
	echo mysql_error();
	echo "<h1>Items available</h1>";
	echo "<table cellpadding='5'>";
	echo "<tr>";
		echo "<th>Image</th>";
		echo "<th>Item</th>";
		echo "<th>Bids</th>";
		echo "<th>Price</th>";
		echo "<th>Bid ends on</th>";
	echo "</tr>";
	if($numrows==0){
		echo "<tr><td colspan=4>No items</td></tr>";
	}
	else{
		while($row=mysql_fetch_assoc($result)){
			$imagesql="SELECT * FROM images WHERE item_id = " . $row['id'] . ";";
			$imageresult=mysql_query($imagesql);
			echo mysql_error();
			$imagenumrows = mysql_num_rows($imageresult);

			echo "<tr>";
			if($imagenumrows==0){
				echo "<td>No image</td>";
			}
			else{
				$imagerow=mysql_fetch_assoc($imageresult);
				echo "<td><img src='./images/" . $imagerow['name'] . "'width='100'></td>";
			}
			echo "<td>";
			echo "<a href='itemdetails.php?id=" . $row['id'] . "'>" . $row['name'] . "</a>";
			if(isset($_SESSION['USERID']))
				if($_SESSION['USERID']==$row['user_id']){
				echo "-[<a href='edititem.php?id=" . $row['id'] . "'>edit</a>";
			}
			echo "</td>";

			$bidsql="SELECT item_id, MAX(amount) AS highestbid, COUNT(id) AS numberofbids FROM bids WHERE item_id =" . $row['id'] . " GROUP BY item_id;";
			$bidresult=mysql_query($bidsql);
			echo mysql_error();
			$bidrow=mysql_fetch_assoc($bidresult);
			$bidnumrows=mysql_num_rows($bidresult);
			echo "<td>";
			if($bidnumrows==0)
				echo "0";
			else
				echo $bidrow['numberofbids'] . "</td>";
			echo "<td>" . $config_currency;
			if($bidnumrows==0)
				echo sprintf('%.2f' , $row['startingprice']);
			else
				echo sprintf('%.2f', $bidrow['highestbid']);
			echo "</td>";
			echo "<td>" . date("D jS F Y g.iA", strtotime($row['dataends'])) . "</td>";
			echo "<tr>";
		}
	}
	echo "</table>";
	require("footer.php");
?>