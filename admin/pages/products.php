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
    	<div id="product-content">
    	<?php
    		while($row = $result->fetch_assoc()){
    			echo '
    					<div class="col-md-3 product-grid">
				    		<div class="product-items">
					    		    <div class="project-eff">
										<div id="nivo-lightbox-demo"> <p> <a href="#'.$row['prod_id'].'" id="nivo-lightbox-demo" data-toggle="modal" data-target=".prod-modal-'.$row['prod_id'].'"><span class="rollover1"> </span> </a></p></div>     
											<img src="../'.$row['prod_picture_link'].'" alt="" height="320px" width="290px">
									</div>
					    		<div class="produ-cost">
					    			<h4>'.$row['prod_name'].'</h4>
					    			<h5>'.$row['inv_price'].' $</h5>
					    		</div>
				    		</div>
				    	</div>
    			';
	echo '
		<div class="modal fade prod-modal-'.$row['prod_id'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">'.$row['prod_name'].'</h4>
		      </div>
		      <div id="modal-alert-'.$row['prod_id'].'" class="alert alert-success hidden" role="alert">Updated Successfully</div>
		      <div class="modal-body" id="modal-test">
		      	<h4><i>Details</i></h4><hr>
		      	 <label for="prod-Name-'.$row['prod_id'].'">Name:</label>
		       	 <input type="text" id="prod-name-'.$row['prod_id'].'" class="form-control" placeholder="Title" aria-describedby="basic-addon1" value="'.$row['prod_name'].'">
		       	 <label for="prod-desc-'.$row['prod_id'].'">Description:</label>
		       	 <textarea class="form-control" rows="5" id="prod-desc-'.$row['prod_id'].'">'.$row['prod_desc'].'</textarea>
				 <div class="form-row">
				  <div class="form-group col-md-6">
				  <label for="prod-genre-'.$row['prod_id'].'">Genre:</label>
				  <select class="form-control" id="prod-genre-'.$row['prod_id'].'">
				    ';
				    $sql2 = "SELECT * FROM product_genre";
					$result2 = $conn->query($sql2);
				    while($row2 = $result2->fetch_assoc()){
				    	if($row['prod_genre_name']==$row2['prod_genre_name'])
				    		echo '<option selected="selected">'.$row2['prod_genre_name'].'</option>';
				    	else
				    		echo '<option>'.$row2['prod_genre_name'].'</option>';
				    }
				    echo'
				  </select>
				  </div>
				  <div class="form-group col-md-6">
				  <label for="prod-type-'.$row['prod_id'].'">Select list:</label>
				  <select class="form-control" id="prod-type-'.$row['prod_id'].'">';
				  		if($row['prod_type_id']==2)
				  			echo'<option selected="selected">Anime</option>
				  				 <option>Game</option>';
				  		else
				  			echo'<option>Anime</option>
				  				 <option selected="selected">Game</option>';
				  echo'
				  </select>
				  </div>
				  <div class="form-group col-md-12">
				  <label for="prod-feature-'.$row['prod_id'].'">Featured:</label>
				  <select class="form-control" id="prod-feature-'.$row['prod_id'].'">';
				  		if($row['prod_featured']=="No")
				  			echo'<option selected="selected">No</option>
				  				 <option>Yes</option>';
				  		else
				  			echo'<option>No</option>
				  				 <option selected="selected">Yes</option>';
				  echo'
				  </select>
				  </div>
				
				<input id="prod-inv-'.$row['prod_id'].'" type="text" value="'.$row['inv_id'].'" hidden>';
				$sql2 = "SELECT * FROM inventory WHERE inv_id='".$row['inv_id']."'";
				$result2 = $conn->query($sql2);
				$result2 = $result2->fetch_assoc();
				$prod_price=$result2['inv_price'];
				echo ' <h4><i>Sales</i></h4><hr>
					  <div class="form-group col-md-2">	
					  <label for="prod-price-'.$row['prod_id'].'">Price:</label>
					  <input type="number" class="form-control" id="prod-price-'.$row['prod_id'].'" value="'.$prod_price.'">
					  </div>';
				$prod_stock=$result2['inv_stock'];
				echo '<div class="form-group col-md-2">
					  <label for="prod-stock-'.$row['prod_id'].'">Stock Left:</label>
					  <input type="number" class="form-control" id="prod-stock-'.$row['prod_id'].'" value="'.$prod_stock.'">
					  </div>';
				echo '<div class="form-group col-md-2">
					  <label for="prod-discount-'.$row['prod_id'].'">Discount(%):</label>
					  <input type="number" class="form-control" id="prod-discount-'.$row['prod_id'].'" value="'.$result2['inv_discount'].'" min=0 max=100>
					  </div>';
				$prod_sold=$result2['inv_no_of_sold'];
				echo '<div class="form-group col-md-2">
					  <label for="prod-sold-'.$row['prod_id'].'">Sold:</label>
					  <span id="prod-sold-'.$row['prod_id'].'" class="input-group-addon" id="basic-addon3">'.$prod_sold.'</span>
					  </div>';
				echo '<div class="form-group col-md-2">
					  <label for="prod-views-'.$row['prod_id'].'">Views:</label>
					  <span id="prod-views-'.$row['prod_id'].'" class="input-group-addon" id="basic-addon3">'.$result2['inv_views'].'</span>
					  </div>';
				echo '<div class="form-group col-md-2">
					  <label for="prod-rate-'.$row['prod_id'].'">Rating:</label>
					  <span id="prod-rate-'.$row['prod_id'].'" class="input-group-addon" id="basic-addon3">'.$result2['inv_rate'].'</span>
					  </div>';
			echo'
			</div>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-primary" onclick="update('.$row['prod_id'].')">Update</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetAlert('.$row['prod_id'].'),chPage()">Close</button>
		      </div>
		    </div>
		  </div>
		</div>';
	}
?>
   	</div>
      <div class="clearfix"> </div>
    </div>
    </div>
</div>
