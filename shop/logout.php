<?php
include_once('../config.php');
?>
<?php
session_start();
unset($_SESSION['userdata']);
header("Location: ".base_url."index.php");
?>
