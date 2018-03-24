<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	<h1>Account Management</h1><hr>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#reg-user-tab" aria-controls="products" role="tab" data-toggle="tab">Regular Accounts</a></li>
		<li role="presentation"><a href="#admin-user-tab" aria-controls="settings" role="tab" data-toggle="tab">Administrative Accounts</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="reg-user-tab">
			<table class="table">
			<thead>
				<tr>
				    <th>User ID</th>
				    <th>E-mail</th>
				    <th>First Name</th>
				    <th>Last Name</th>
				    <th>Account Details</th>
				    <th>Account Address</th>
				    <th>Account Access</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql="SELECT * FROM account,account_type,account_details,account_address WHERE account.acc_type_id=account_type.acc_type_id AND account.acc_id=account_details.acc_id AND account.acc_id=account_address.acc_id AND account_type.acc_type_id='1'";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()){
						echo '
							<tr>
							<td>'.$row['acc_id'].'</td>
							<td>'.$row['acc_email'].'</td>
							<td>'.$row['acc_fname'].'</td>
							<td>'.$row['acc_lname'].'</td>
							<td><button class="btn btn-default" data-toggle="modal" data-target="#view-details-'.$row['acc_id'].'">View Details</button></td>
							<td><button class="btn btn-default" data-toggle="modal" data-target="#view-address-'.$row['acc_id'].'">View Address</button></td>
							<td><button class="btn btn-default" data-toggle="modal" data-target="#change-access-'.$row['acc_id'].'">Change</button></td>
							</tr>
							';

						echo '
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="view-details-'.$row['acc_id'].'">
					  		<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="form-group">
									    <label for="accgender">Gender</label>
									    <input type="text" class="form-control" id="accgender" placeholder="'.$row['acc_details_gender'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accbday">Birthdate</label>
									    <input type="text" class="form-control" id="accbday" placeholder="'.$row['acc_details_bday'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accpnum">Gender</label>
									    <input type="text" class="form-control" id="accpnum" placeholder="'.$row['acc_details_pnum'].'" readonly>
									</div>
							 	</div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
							';

						echo '
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="view-address-'.$row['acc_id'].'">
					  		<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="form-group">
									    <label for="accprovince">Province</label>
									    <input type="text" class="form-control" id="accprovince" placeholder="'.$row['address_province'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="acccountry">Country</label>
									    <input type="text" class="form-control" id="acccountry" placeholder="'.$row['address_country'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="acccity">City</label>
									    <input type="text" class="form-control" id="acccity" placeholder="'.$row['address_city'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="acczipp">Zipcode</label>
									    <input type="text" class="form-control" id="acczipp" placeholder="'.$row['address_zipcode'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accadd1">Address Line 1</label>
									    <input type="text" class="form-control" id="accadd1" placeholder="'.$row['address_line1'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accadd2">Address Line 2</label>
									    <input type="text" class="form-control" id="accadd2" placeholder="'.$row['address_line2'].'" readonly>
									</div>
							 	</div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
							';

						echo '
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="change-access-'.$row['acc_id'].'">
					  		<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="form-group">
									    <label for="chcaccess">Change access type</label>
									    <select class="form-control" id="chcaccess">';
										$sql2 = "SELECT * FROM account_type WHERE acc_type_id!=5";
										$result2 = $conn->query($sql2);
										while($row2 = $result2->fetch_assoc()){
											echo '<option value="'.$row2['acc_type_id'].'">'.$row2['acc_type_name'].'</option>';
										}
							echo'			  
										</select>
									</div>
							 	</div>
						      <div class="modal-footer">
						      	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="chcaccess('.$row['acc_id'].')">Update</button>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
							';
				 }
			?>
			</tbody>
		 </table>
		</div>
		<div role="tabpanel" class="tab-pane" id="admin-user-tab">
			<table class="table">
			<thead>
				<tr>
				    <th>User ID</th>
				    <th>E-mail</th>
				    <th>First Name</th>
				    <th>Last Name</th>
				    <th>Account Details</th>
				    <th>Account Address</th>
				    <th>Account Access</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql="SELECT * FROM account,account_type,account_details,account_address WHERE account.acc_type_id=account_type.acc_type_id AND account.acc_id=account_details.acc_id AND account.acc_id=account_address.acc_id AND account_type.acc_type_id!='1' AND account_type.acc_type_id!='5'";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()){
						echo '
							<tr>
							<td>'.$row['acc_id'].'</td>
							<td>'.$row['acc_email'].'</td>
							<td>'.$row['acc_fname'].'</td>
							<td>'.$row['acc_lname'].'</td>
							<td><button class="btn btn-default" data-toggle="modal" data-target="#view-details-'.$row['acc_id'].'">View Details</button></td>
							<td><button class="btn btn-default" data-toggle="modal" data-target="#view-address-'.$row['acc_id'].'">View Address</button></td>
							<td><button class="btn btn-default" data-toggle="modal" data-target="#change-access-'.$row['acc_id'].'">Change</button></td>
							</tr>
							';

						echo '
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="view-details-'.$row['acc_id'].'">
					  		<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="form-group">
									    <label for="accgender">Gender</label>
									    <input type="text" class="form-control" id="accgender" placeholder="'.$row['acc_details_gender'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accbday">Birthdate</label>
									    <input type="text" class="form-control" id="accbday" placeholder="'.$row['acc_details_bday'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accpnum">Gender</label>
									    <input type="text" class="form-control" id="accpnum" placeholder="'.$row['acc_details_pnum'].'" readonly>
									</div>
							 	</div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
							';

						echo '
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="view-address-'.$row['acc_id'].'">
					  		<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="form-group">
									    <label for="accprovince">Province</label>
									    <input type="text" class="form-control" id="accprovince" placeholder="'.$row['address_province'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="acccountry">Country</label>
									    <input type="text" class="form-control" id="acccountry" placeholder="'.$row['address_country'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="acccity">City</label>
									    <input type="text" class="form-control" id="acccity" placeholder="'.$row['address_city'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="acczipp">Zipcode</label>
									    <input type="text" class="form-control" id="acczipp" placeholder="'.$row['address_zipcode'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accadd1">Address Line 1</label>
									    <input type="text" class="form-control" id="accadd1" placeholder="'.$row['address_line1'].'" readonly>
									</div>
									<div class="form-group">
									    <label for="accadd2">Address Line 2</label>
									    <input type="text" class="form-control" id="accadd2" placeholder="'.$row['address_line2'].'" readonly>
									</div>
							 	</div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
							';

						echo '
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="change-access-'.$row['acc_id'].'">
					  		<div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Account Details</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<div class="form-group">
									    <label for="chcaccess">Change access type</label>
									    <select class="form-control" id="chcaccess">';
										$sql2 = "SELECT * FROM account_type WHERE acc_type_id!=5";
										$result2 = $conn->query($sql2);
										while($row2 = $result2->fetch_assoc()){
											echo '<option value="'.$row2['acc_type_id'].'">'.$row2['acc_type_name'].'</option>';
										}
							echo'			  
										</select>
									</div>
							 	</div>
						      <div class="modal-footer">
						      	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="chcaccess('.$row['acc_id'].')">Update</button>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
							';
				 }
			?>
			</tbody>
		 </table>
		</div>
	</div>		
	</div>
</div>