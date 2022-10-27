<?php 
$product_id = $row['product_id'];
$quantity = $row['quantity'];
$sql = "SELECT * FROM product_info WHERE id = $product_id";
$product_results = $conn->query($sql);
if ($product_results->num_rows > 0) {
	$row = $product_results->fetch_assoc(); 
	$name = $row['name'];
	$price = $row['price'];
	$availability = $row['availability'];
	$image = $row['image'];
	$category = $row['category'];
}
?>

<div class="cart_products">
	<div class="cart_product_box">
		<div class="box">
			<img src="Images/<?php print($image)?>">
		</div>
		
		<div class="box">
			<h3 style="font-size: 20px; text-transform: capitalize; "><?php print($name); ?></h3>
			<p>In Stock: <?php print($availability); ?></p>
			<p>Category: <?php print($category); ?></p>
		</div>

		<div class="box">
			<h3>Each</h3>
			<p style="color: #25242A; font-weight: bolder;">$<?php print($price); ?></p>
		</div>

		<div class="box">
			<h3>Quantity</h3>
			<form method="post" action="cart_edit.php?qid=<?php print($product_id)?>">
				<input type="number" name="quantity" value="<?php print($quantity); ?>">
			</form>
		</div>

		<div class="box">
			<h3>Total</h3>
			<p style="color: #25242A; font-weight: bolder;">$<?php print($price*$quantity); ?></p>
			<?php $total = $total + ($price * $quantity); ?>
		</div>
	</div>
	
	<div class="cart_extras">
		<a href="cart_edit.php?id=<?php print($product_id)?>">Remove</a>
		<a href="">Move to Wishlist</a>
	</div>
</div>