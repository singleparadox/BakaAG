<?php
	include "../../backend/connection.php";
	$sql = "SELECT * FROM product,inventory,product_genre,product_type WHERE inventory.inv_id=product.inv_id AND product_genre.prod_genre_id=product.prod_genre_id AND product_type.prod_type_id=product.prod_type_id";
	$result = $conn->query($sql);
?>
<div class="inner-block">
	<div class="blank">
	<div class="product-block">
    	<div class="pro-head">
    		<h2>Products</h2>
    	</div>
    	<?php
    		while($row = $result->fetch_assoc()){
    			echo '
    					<div class="col-md-3 product-grid">
				    		<div class="product-items">
					    		    <div class="project-eff">
										<div id="nivo-lightbox-demo"> <p> <a href="#'.$row['prod_id'].'" id="nivo-lightbox-demo" data-toggle="modal" data-target=".prod-modal-'.$row['prod_id'].'"><span class="rollover1"> </span> </a></p></div>     
											<img class="img-responsive" src="images/pro1.jpg" alt="">
									</div>
					    		<div class="produ-cost">
					    			<h4>'.$row['prod_name'].'</h4>
					    			<h5>'.$row['inv_price'].' $</h5>
					    		</div>
				    		</div>
				    	</div>
    			';
    		
    	?>
    	
    	
      <div class="clearfix"> </div>
    </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
			<script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){
				    $('#nivo-lightbox-demo a').nivoLightbox({ effect: 'fade' });
				});
				x=2;
				console.log(x);
				</script>
<?php
	echo '
		<div class="modal fade prod-modal-'.$row['prod_id'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Product Details</h4>
		      </div>
		      <div class="modal-body">
		        ...
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

	';
	}
?>
