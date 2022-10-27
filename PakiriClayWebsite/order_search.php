<?php
include("setup.php");
session_start();

$_SESSION['order'] = $_POST["order"];
if ($_POST["order"] == "Newest Item") {
	$_SESSION['order'] = "id DESC";
}
elseif ($_POST["order"] == "Lowest Price") {
	$_SESSION['order'] = "price ASC";
}
else {
	$_SESSION['order'] = "price DESC";
}
$_SESSION['page'] = 0;

header('Location: store.php');
?>