<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	 	<div>

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#products-tab" aria-controls="products" role="tab" data-toggle="tab">Products</a></li>
		    <li role="presentation"><a href="#" aria-controls="profile"  data-toggle="modal" data-target=".product_modal">Add new Product</a></li>
		    <li role="presentation"><a href="#" aria-controls="messages" data-toggle="modal" data-target=".category">Add new Category</a></li>
		    <li role="presentation"><a href="#transactions-tab" aria-controls="settings" role="tab" data-toggle="tab">Transactions</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="products-tab">
		    	<?php
			    		$sql = "SELECT * FROM product,inventory,product_genre,product_type WHERE inventory.inv_id=product.inv_id AND product_genre.prod_genre_id=product.prod_genre_id AND product_type.prod_type_id=product.prod_type_id AND prod_featured='Yes'";
						$result = $conn->query($sql);
			    		while($row = $result->fetch_assoc()){
			    			echo '
			    					<div class="col-md-2 product-grid">
							    		<div class="product-items">
								    		    <div class="project-eff">
													<div id="nivo-lightbox-demo"> <p> <a href="#'.$row['prod_id'].'" id="nivo-lightbox-demo" data-toggle="modal" data-target=".prod-modal-'.$row['prod_id'].'"><span class="rollover1"> </span> </a></p></div>     
														<img src="../'.$row['prod_picture_link'].'" alt="" height="120px" width="173px">
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
					        <h6 class="modal-title" id="myModalLabel">Product Code: '.$row['prod_codeid'].'</h6>
					      </div>
					      <div id="modal-alert-'.$row['prod_id'].'" class="alert alert-success hidden" role="alert">Updated Successfully</div>
					      <div class="modal-body" id="modal-test">
					      	<h4><i>Details</i></h4>
					      	<h5>Date Added: '.$row['prod_dateadd'].'</h5>
					      	<hr>
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
		    	<center><button class="btn btn-default btn-lg" onclick="chPage()">View all products</button></center>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="transactions-tab">
		    	<?php include "pages/transactions.php";?>
		    </div>
		  </div>

		</div>
	</div>
</div>



<!--Add New Product-->
	<div class="modal fade bs-example-modal-lg product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	    	<form action="pages/backend/addproduct.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add New Product</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="form-group col-md-6">
	      		<label for="new-prod-pic">Product Picture:</label>
					<input type="file" id="new-prod-pic" name="new-prod-pic" class="form-control-file" placeholder="Title" aria-describedby="basic-addon1">
			</div>
			<div class="form-group col-md-6">
	      		<label for="date">Date:</label>
					  <span id="date" class="input-group-addon" id="basic-addon3"><?php echo date("Y-m-d")?></span>
					  <input id="new-prod-date" name="new-prod-date" type="date" value="<?php echo date('Y-m-d')?>" hidden>
			</div>
	      	<label for="new-prod-name">Product Name:</label>
				<input type="text" id="new-prod-name" name="new-prod-name" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
			<label for="new-prod-desc">Product Description:</label>
				<input type="textarea" id="new-prod-desc" name="new-prod-desc" class="form-control" placeholder="Enter Description" aria-describedby="basic-addon1">
			<div class="form-row">
			<div class="form-group col-md-3">
			<label for="new-prod-genre">Product Genre:</label>
				<select class="form-control" id="new-prod-genre" name="new-prod-genre">
					<?php
						$sql = "SELECT * FROM product_genre ORDER BY prod_genre_name ASC";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							echo '<option>'.$row['prod_genre_name'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
			<label for="new-prod-type">Product Type:</label>
				<select class="form-control" id="new-prod-type" name="new-prod-type">
					<?php
						$sql = "SELECT * FROM product_type";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							echo '<option>'.$row['prod_type_name'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-3">
			<label for="new-prod-price">Product Price:</label>
				<input type="number" id="new-prod-price" name="new-prod-price" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="0">
			</div>
			<div class="form-group col-md-3">
			<label for="new-prod-sock">Product Stock:</label>
				<input type="number" id="new-prod-stock" name="new-prod-stock" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="0">
			</div>
		  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Confirm</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!--Add New Product End-->

	<!--Add New Category-->
	<div class="modal fade bs-example-modal-lg category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<a class="btn link" id="edit-button">EDIT MODE</a>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" id="removeAdd">
	    	<form action="pages/backend/addcategory.php" method="POST" enctype="multipart/form-data" id="toBeremoved">
	      <div class="modal-header" id="toBeremoved">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
	      </div>
	      <div class="modal-body" id="toBeremoved">
	      	<label for="new-categ-pic">Category Picture:</label>
				<input type="file" id="new-categ-pic" name="new-categ-pic" class="form-control-file" aria-describedby="basic-addon1">
	      	<label for="new-categ-name">Category Name:</label>
				<input type="text" id="new-categ-name" name="new-categ-name" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
			<label for="new-categ-desc">Category Description:</label>
				<input type="textarea" id="new-categ-desc" name="new-categ-desc" class="form-control" placeholder="Enter Description" aria-describedby="basic-addon1">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Confirm</button>
	      </div>
	      </form>
	  	</div>

	      <!--EDIT (UNDER CONSTRUCTION)-->
	      <div class="modal-content"  id="edit-content" style="display: none;">
	    	<form action="pages/backend/updatecategory.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header" id="">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
	      </div>
	      <div class="modal-body" id="">
	      	<label for="new-categ-pic">Edit Category Picture:</label>
	      	<input type="file" id="new-categ-pic" name="new-categ-pic" class="form-control-file" aria-describedby="basic-addon1">
	      	<label for="new-categ-name"> Edit Category Name:</label><br>
			<select type="text" id="new-categ-name" name="new-categ-name" onchange="changeInputData(this)" class="form-control" placeholder="Title" aria-describedby="basic-addon1" style="display:inline-block;width: 30%">
				<option value="none">Select Category</option>
				<?php
					$sql = "SELECT prod_genre_id AS id, prod_genre_name AS genre FROM product_genre ORDER BY prod_genre_name ASC";
					$res = $conn->query($sql);

					while ($row = $res->fetch_assoc()) {
						echo "<option value='".$row['id']."'>".$row['genre']."</option>";
					}
				?>
			</select>

			<input type="text" id="new-categ-new-name" name="new-categ-new-name" class="form-control" placeholder="New Name" aria-describedby="basic-addon1" style="display: inline-block; width: 69.49%;">


			<label for="new-categ-desc">Edit Category Description:</label>
				<input type="textarea" id="new-categ-desc" name="new-categ-desc" class="form-control" placeholder="Enter Description" aria-describedby="basic-addon1">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Confirm</button>
	      </div>
	      </form>

	      </div>
	      <script type="text/javascript">
			var a = document.getElementById('edit-button');
			var edit = document.getElementById("edit-content");
			var myElement = document.getElementById('removeAdd');

			var currName = document.getElementById('new-categ-name');
			var editInput = document.getElementById('new-categ-new-name');

			function changeInputData (e) {
				document.getElementById('new-categ-new-name').value = e.options[e.selectedIndex].text;
			}


			a.onclick = function(e) {
				if (this.innerHTML == "GO BACK") {
					this.innerHTML = "EDIT MODE";
					edit.style.display = "none";
					myElement.style.display = "block";
				}

				else {
					this.innerHTML = "GO BACK";
					myElement.style.display = "none";
					edit.style.display = "block";
				}
				
				
				//myElement.style.visibility = "hidden";

			};
	      </script>
	    </div>
	  </div>
	</div>
	<!--Add New Category End-->