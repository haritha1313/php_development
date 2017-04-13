<?php
session_start();
require("config.php");
session_unset();
session_destroy();
header("Location: " . $config_basedir);
?>