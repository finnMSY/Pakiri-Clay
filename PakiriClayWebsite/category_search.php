<?php
include("setup.php");
session_start();
$_SESSION['category'] = $_POST["category"];

if ($_SESSION['category'] == 'All') {
	unset($_SESSION['category']);
}
$_SESSION['page'] = 0;

header('Location: store.php');
?>