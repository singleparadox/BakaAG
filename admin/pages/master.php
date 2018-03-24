<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#master-dashboard-tab" aria-controls="products" role="tab" data-toggle="tab">Dasboard</a></li>
		<li role="presentation"><a href="#master-accounts-tab" aria-controls="settings" role="tab" data-toggle="tab">Account Management</a></li>
		<li role="presentation"><a href="#master-products-tab" aria-controls="settings" role="tab" data-toggle="tab">Product Management</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="master-dashboard-tab">
			<?php
				include "dashboard.php";
			?>
		</div>

		<div role="tabpanel" class="tab-pane active" id="master-accounts-tab">
			<?php
				include "accmgmt.php";
			?>
		</div>

		<div role="tabpanel" class="tab-pane active" id="master-products-tab">
			<?php
				include "warehouse.php";
			?>
		</div>
	</div>
	</div>
</div>