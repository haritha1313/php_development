<style type="text/css">
	

h1 {
  text-align: center;
  font-family: Tahoma, Arial, sans-serif;
  color: #06D85F;
  margin: 80px 0;
}

.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: black;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
 visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  height: 80%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 80%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>
<?php
session_start();
require("connect1.php");
$username = "";
$password = "";
if(isset($_POST['submit'])){
	if($username == ""){
		header("Location: admin.php?error=emptyuser");
	}else
	if($password==""){
		header("Location: admin.php?error=emptypass");
	}
	$sql = "SELECT * FROM admin WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';"; 
	$result=mysql_query($sql);
	$numrows=mysql_num_rows($result);

	if($numrows==1){
		$row=mysql_fetch_assoc($result);
			$_SESSION['ADMIN']=$row['username'];
			header("Location: index.php");
			}
		
	}else{
		header("Location: admin.php?error=wrongdet");
	}
	}
else{
	
	
?>
<h1>Admin Login</h1>
<div class="box">
	<a class="button" href="#popup1">Admin login</a>
</div>

<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Login</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
		<?php
		if(isset($_GET['error'])){
			switch($_GET['error']){
				case "emptyuser": echo "Please enter username";
				break;
				case "emptypass": echo "Please enter password";
				break;
				case "wrongdet": echo "Oh oh! Authentication error";
				break;
			}
		}?>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
<table>
	<tr>
	<td>Username</td>
	<td><input type="text" name="username"></td>
	</tr>
	<tr>
	<td>Password</td>
	<td><input type="password" name="password"></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Login"></td>
	</tr>
</table>
</form>
<?php
}
require("footer.php");
?>
