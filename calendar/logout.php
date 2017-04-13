<?php
session_start();
session_unset();
session_destroy();
require("config.php");
header("Location: " . $config_basedir . "login.php");
?>