<?php
include("setup.php");
session_start();

$_SESSION['available'] = $_POST["availablity"];
if ($_POST["availablity"] == "Available") {
	$_SESSION['available'] = "Yes";
}
else {
	$_SESSION['available'] = "No";
}
$_SESSION['page'] = 0;

header('Location: store.php');
?>