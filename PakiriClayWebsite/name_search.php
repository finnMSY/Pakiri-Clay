<?php
include("setup.php");
session_start();

$_SESSION['name'] = $_POST["name"];
$_SESSION['page'] = 0;

header('Location: store.php');
?>