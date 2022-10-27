<div class="store_image">
	<img src="Images/<?php print($row["image"])?>" class="storeimg">
	<div class="overlay">
		<div class="text">
			<u style="text-transform: capitalize;"><?php print($row["name"])?></u>
			<p>$<?php print($row["price"])?></p>
			<a href="product_info.php?product=<?php print($row["id"])?>">See More</a><br>
			<form name="addForm" method="post" action="add_to_cart.php">
				<input type="hidden" name="id" value="<?php print($row["id"])?>">
				<input type="hidden" name="quantity" value="1">
				<button type="submit">Add to Cart</button>
			</form>
		</div>
	</div>
</div>

