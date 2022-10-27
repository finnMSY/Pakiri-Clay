<?php 
$pageID = 4;
include('navigation.php'); 
$discount = 0;
?>

<main style="margin: auto; width: 85%; margin-top: 80px; ">
	
	<div class="cart_grid">
		
		<div class="cart_header">
			<h1><img src="Images/carticon.png" width="30"> My Cart</h1>
		</div>

		<div class="cart_bag">
			<?php
			if (isset($_SESSION["account"])) {
				$account_id = $_SESSION["account"];
			}
			else {
				$account_id = 0;
			}

			$sql = "SELECT * FROM cart WHERE account_id = '$account_id'";
			$result = $conn->query($sql);
			$count = 0;
			$total = 0;

			if ($result->num_rows > 0) {
				while ($row = mysqli_fetch_array($result)) {
					include('cartbox.php');
					$count++;
				}
			}
			?>
			<p style="margin-bottom: 80px; font-weight: bolder;"><?php print($count);?> Items <spam class="cart_info_num">Total: $<?php print($total)?></spam></p>
		</div>

		<div class="cart_info">
			<p>Enter Promo Code</p>
			<input type="" name="" placeholder="Promo Code">
			<button>Apply</button>

			<p>Shipping Cost: <span class="cart_info_num">FREE</span></p>
			<p>Discount: <span class="cart_info_num">$<?php print($discount);?></span></p>
			<h2>Estimated Total: <span class="cart_info_num">$<?php print($total - $discount);?></span></h2>

			<button href="" class="cart_info_submit">Checkout</button>
		</div>

	</div>

</main>