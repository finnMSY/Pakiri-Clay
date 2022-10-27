<?php 
if (isset($_SESSION['homePage']) && $_SESSION['homePage'] == 1) {
	?>
	<style type="text/css">
		* {
			scroll-behavior: smooth;
		}
	</style>
	<?php
}
else {
	?>
	<style type="text/css">
		* {
			scroll-behavior: none;
		}
	</style>
	<?php
}
?>
