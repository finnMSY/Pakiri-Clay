<?php
include("setup.php");
session_start();
	
if (isset($_SESSION["name"])) {
	unset($_SESSION["name"]);
}
if (isset($_SESSION["category"])) {
	unset($_SESSION["category"]);
}
if (isset($_SESSION["order"])) {
	unset($_SESSION["order"]);
}
if (isset($_SESSION["available"])) {
	unset($_SESSION["available"]);
}
header('Location: store.php');
?>