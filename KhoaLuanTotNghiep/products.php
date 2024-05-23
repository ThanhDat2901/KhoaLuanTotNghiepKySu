<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

<div class="main">
	<div class="content">
		<div style="background-color: coral;" class="content_top">
			<div  class="heading">
				<h3 >Latest from</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group" style="margin-left: 100px;">
			<?php
			$productList = $product->show_product();
			if ($productList) {
				while ($result = $productList->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4" style="width: 250px;margin: 15px;border-radius: 15px">
					<a href="details.php?proid=<?php echo $result['productId'] ?>" class="details"><img style="width:100px" src="./admin/uploads/<?php echo $result['image'] ?>"alt="" /></a>
						<h2 style="font-size:14px;color: blue;"><?php echo $result['productName'] ?></h2>
						<p style="font-size:15px ;color: red;">Price: <span class="price"  style="font-size:15px ;color: red;"><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></span></p>
					</div>
			<?php
				}
			}
			?>

		</div>
<?php
include 'inc/footer.php';

?>