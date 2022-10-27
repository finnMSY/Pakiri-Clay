<?php 
$pageID = 3;
$image = "";
$productID = $_GET["product"];	
include('navigation.php'); 

$sql = "SELECT * FROM product_info WHERE id = $productID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc(); 
	$image = $row["image"];
	$name = $row["name"];
	$price = $row["price"];
	$description = $row["description"];
}
?>

<div style="width: 90%; margin: auto; margin-top: 80px;">
	<div class="product_grid">

		<div class="product_images">
			<img src="Images/<?php print($image)?>">
		</div>

		<div class="product_info_box">
			<div class="product_info">
				<h1>$<?php print($price); ?></h1>
				<p><?php print($description); ?></p>
				<form name="addForm" method="post" action="add_to_cart.php">
					<input type="number" name="quantity" value="1">
					<input type="hidden" name="id" value="<?php print($row["id"])?>">
					<button type="submit">Add to Cart</button>
				</form>
			</div>
		</div>

		<div class="product_title">
			<a href="store.php" style="position: absolute; top: 16%;"><</a><h2><?php print($name); ?></h2>
		</div>

	</div>
</div>