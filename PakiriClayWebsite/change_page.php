<?php
session_start();
if (isset($_GET["pageNext"])) {
	$_SESSION["page"] = $_GET["pageNext"] + 1;
}
else {
	$_SESSION["page"] = $_GET["pagePrev"] - 1;
}
header("Location: store.php");
?>