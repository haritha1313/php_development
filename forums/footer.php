</div>
<div id="footer">
&copy; 2016 <?php echo "<a href='mailto:" . $config_adminemail . "'>" . $config_admin . "</a>"; ?>
 <?php
	if(isset($_SESSION['ADMIN'])==TRUE){
	echo "[<a href='adminlogout.php'>Logout</a>]";
}
else{
	echo "[<a href='admin.php'>Admin Login</a>]";
}
?>
</div>
</body>
</html>