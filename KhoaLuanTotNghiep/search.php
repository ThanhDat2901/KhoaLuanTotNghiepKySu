<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<?php
	     	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			        $tukhoa = $_POST['tukhoa'];
			        $search_product = $product->search_product($tukhoa);
			        
			    }
	      	?>
    	<div class="content_top">
    		
    		<div class="heading">	
    		<h3>Từ khóa tìm kiếm : <?php echo $tukhoa ?></h3>
    		</div>
    		
    		<div class="clear"></div>

    	</div>
    	
	      <div class="section group" style="margin-left: 100px;">
	      	<?php
	      	
	      	 if($search_product){
	      	 	while($result = $search_product->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4"  style="width: 250px;margin: 15px;border-radius: 15px;">
					 <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" /></a>
					 <h2  style="font-size:14px;color: blue;"><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],50); ?></p>
					 <p style="font-size:15px ;color: red;">Price: <span style="font-size:15px ;color: red;" class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></p>
				</div>
			<?php
			}

		}else{
			echo 'Category Not Avaiable';
		}
			?>
			</div>

	
	
    </div>
 </div>
<?php 
	include 'inc/footer.php';
	
 ?>
