<?php
include ('setup.php');
session_start();
$product_id = $_POST["id"];
$quantity = $_POST["quantity"];

if (isset($_SESSION["account"])) {
	$account_id = $_SESSION["account"];
}
else {
	$account_id = 0;
}

$sql = "SELECT * FROM cart WHERE product_id = $product_id AND account_id = $account_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc(); 
	$original_quantity = $row["quantity"];
	$new_quantity = $original_quantity + $quantity;
	$sql = "UPDATE cart set quantity='$new_quantity' WHERE product_id = $product_id AND account_id = $account_id";
	if ($conn->query($sql) === TRUE) {
	  echo "Record updated successfully";
	  header("Refresh:0");
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
else {
	$sql = "INSERT INTO cart (product_id, account_id, quantity) VALUES ('$product_id', '$account_id', '$quantity')";
	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  header("Location: store.php");
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
$conn->close();

header("Location: store.php");
?>