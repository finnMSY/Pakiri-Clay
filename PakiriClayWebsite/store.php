<?php 
$pageID = 2;	
include('navigation.php'); 
$_SESSION['scroll'] = "none";

$product_ids = [];
$columnOne = [];
$columnTwo = [];
$columnThree = [];
$category_array = [];
$noResults = False;
$pageSize = 9;

if (isset($_SESSION["page"])) {
	$pageNum = $_SESSION["page"];
}
else {
	$pageNum = 0;
}

$search = '';
if (isset($_SESSION['name'])) {
	$search = $_SESSION['name'];
}
else {
	$search = '';
}

$category = '';
if (isset($_SESSION['category'])) {
	$category = $_SESSION['category'];
}
else {
	$category = '';
}

$order = '';
if (isset($_SESSION['order'])) {
	$order = $_SESSION['order'];
}
else {
	$order = 'id ASC';
}

$available = '';
if (isset($_SESSION['available'])) {
	$available = $_SESSION['available'];
}
else {
	$available = '';
}


$sql = "SELECT category FROM product_info";
$result = $conn->query($sql);

while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
	foreach ($row as $item){
		if (!in_array($item, $category_array)) {
	    	array_push($category_array, $item);
	    }
	} 
}

$sql = "SELECT * FROM product_info WHERE category LIKE '%$category%' AND name LIKE '%$search%' AND availability LIKE '%$available%' ORDER BY $order";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
	$noResults = True;
}
else {
	$ids = [];
	while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
	    array_push($ids, $row["id"]);
	    if (count($ids) == $pageSize) {
	   		array_push($product_ids, $ids);
	   		$ids = [];
	    }
	}
	if (count($ids) > 0) {
		array_push($product_ids, $ids);
	}
}
$maxPages = count($product_ids);

for($i = 0; $i < count($product_ids[$pageNum]); $i++) {
	if ($i % 3 == 0) {
		array_push($columnOne, $product_ids[$pageNum][$i]);
	}
	elseif (($i-1) % 3 == 0) {
		array_push($columnTwo, $product_ids[$pageNum][$i]);
	}
	else {
		array_push($columnThree, $product_ids[$pageNum][$i]);
	}
}
?>

<div id="storeBanner" style="z-index: 2;"> 
	<h2>Store</h2>
</div>
<div style="width: 70%; margin: auto;">
	<!-- <p><a href="index.php">Home</a> / <a href="store.php" style="color: #86C02A;">Store</a></p> -->
	<div id="filterDiv">
		<div style="grid-area: filterText;"><span>FILTER BY:</span></div>
		<form style="grid-area: filterClear; text-align: right;" name="clearform" action="reset.php" method="post">
			<button type="submit">CLEAR ALL</button>
		</form>
		<form style="grid-area: filterName; text-align: left;" name="nameform" action="name_search.php" method="post">
			<input type="text" name="name" placeholder="Search by name..." value="<?php if(isset($_SESSION["name"])) {print($_SESSION["name"]);} ?>">
		</form>
		<form style="grid-area: filterPrice; text-align: center;" name="orderform" action="order_search.php" method="post">
			<select onchange="orderform.submit();" name="order">
				<option selected disabled>Order by...</option>
				<option <?php if(isset($_SESSION["order"]) && $_SESSION["order"] == "id DESC") {print("selected");}?>>Newest Item</option>
				<option <?php if(isset($_SESSION["order"]) && $_SESSION["order"] == "price ASC") {print("selected");}?>>Lowest Price</option>
				<option <?php if(isset($_SESSION["order"]) && $_SESSION["order"] == "price DESC") {print("selected");}?>>Highest Price</option>
			</select>
		</form>
		<form style="grid-area: filterCategory; text-align: center;" name="categoryform" action="category_search.php" method="post">
			<select onchange="categoryform.submit();" name="category"> 
				<option disabled selected>Category...</option>
				<option>All</option>
				<?php 
				foreach ($category_array as $item) {
					?><option 
					<?php 
					if(isset($_SESSION["category"])) {
						if ($_SESSION["category"] == $item) {
							print("selected");
						}
					} 
					?>
					><?php print($item); ?></option><?php
				}
				?>
			</select>
		</form>
		<form style="grid-area: filterAvailability; text-align: right;" name="availableform" action="availability_search.php" method="post">
			<select onchange="availableform.submit();" name="availablity">
				<option disabled selected>Availablity...</option>
				<option <?php if(isset($_SESSION["available"]) && $_SESSION["available"] == "Yes") {print("selected");}?>>Available</option>
				<option <?php if(isset($_SESSION["available"]) && $_SESSION["available"] == "No") {print("selected");}?>>Not available</option>
			</select>
		</form>
	</div>
	<br><br>

	<div style="display: <?=$noResults ? '' : 'none'?>"> 
		<!-- Temporary Message, will style later -->
		<h1>No Results with these filters</h1>
	</div>

	<div class="storeGrid">
		<div class="storeGrid-column1 columm">
			<?php 
			foreach ($columnOne as $item) {
				$sql = "SELECT * FROM product_info WHERE id = $item";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc(); 
					include "storebox.php";
				}
			}
			?>
		</div>
		<div class="storeGrid-column2 columm">
			<?php 
			foreach ($columnTwo as $item) {
				$sql = "SELECT * FROM product_info WHERE id = $item";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc(); 
					include "storebox.php";
				}
			}
			?>
		</div>
		<div class="storeGrid-column3 columm">
			<?php 
			foreach ($columnThree as $item) {
				$sql = "SELECT * FROM product_info WHERE id = $item";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc(); 
					include "storebox.php";
				}
			}
			?>
		</div>
	</div>
	<div style="margin-bottom: 40px; margin-top: 20px; text-align: center;">
		<a class="directionalbtns" href="change_page.php?pagePrev=<?php print($pageNum)?>" style="display: <?=$pageNum <= 0 ? 'none' : ''?>">Previous Page</a>
		<a class="directionalbtns" href="change_page.php?pageNext=<?php print($pageNum)?>" style="display: <?=$pageNum >= $maxPages-1 ? 'none' : ''?>; ">Next Page</a>
		<!-- <input type="text" class="datepicker"> -->
	</div>

	<!-- Date picker Javascript  -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(function() {
		  $('.datepicker').datepicker({
		    "dateFormat": 'yy/mm/dd',
		    'minDate': new Date(),
		    beforeShowDay: function(dt) {
		      if (dt.getMonth() >= 0 && dt.getMonth() <= 11	) {        
		        return [dt.getDay() == 0 || dt.getDay() == 6, ""];
		      } 
		      else {
		        return [false, "", ""];
		      }
		    }
		  });
		});
	</script>
</div>