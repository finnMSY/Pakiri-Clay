<?php 
include ('setup.php');
session_start();
if (isset($_SESSION['account'])) {
	$account_id = $_SESSION['account'];
}
else {
	$account_id = 0;
}

if (isset($_GET['id'])) {
	$product_id = $_GET['id'];

	$sql = "DELETE FROM cart WHERE account_id='$account_id' AND product_id='$product_id'";
	if ($conn->query($sql) === TRUE) {
	  //echo "Record updated successfully";
	  header("Location: cart.php");
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
else if (isset($_POST['quantity'])) {
	$new_quantity = $_POST['quantity'];
	$product_id = $_GET['qid'];

	$sql = "UPDATE cart set quantity='$new_quantity' WHERE product_id = $product_id AND account_id = $account_id";
	if ($conn->query($sql) === TRUE) {
	  echo "Record updated successfully";
	  header("Location: cart.php");
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>