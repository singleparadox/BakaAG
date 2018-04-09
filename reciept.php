<?php
	session_start();
	include_once("backend/connection.php");

	date_default_timezone_set('Asia/Singapore');	
	$oid = (string)$_GET['oid'];
	$uid = isset($_SESSION['acc_id']) ? $_SESSION['acc_id']: '';

	$sql_check = "SELECT * FROM orders WHERE order_id='".$oid."'";
	$result = $conn->query($sql_check);
	$fetch_check = $result->fetch_assoc();

	if (($uid != $fetch_check['acc_id']) OR ($result->num_rows < 1)) {
		header('HTTP/1.0 403 Forbidden');
		echo "<html>
				<head>
				<title>403 Forbidden</title>
				</head>
				<body>
				<h1>Forbidden</h1>
				<p>You don't have permission to access ".$_SERVER['REQUEST_URI']."
				on this server.</p>
				</head>
				</html>
				";
		exit;
	}

    if (!isset($_GET['p'])) {
        $sql_data = "SELECT * FROM orders, order_mdofpymt,account,receipt,account_address,order_status WHERE orders.order_id='".$oid."' AND order_mdofpymt.order_mdpaymt_id=orders.order_mdpaymnt_id AND account.acc_id=orders.acc_id AND receipt.order_id=orders.order_id AND account_address.acc_id=account.acc_id AND order_status.order_status_id=orders.order_status_id";
    } else {
        $sql_data = "SELECT * FROM orders, order_mdofpymt,account,account_address,order_status WHERE orders.order_id='".$oid."' AND order_mdofpymt.order_mdpaymt_id=orders.order_mdpaymnt_id AND account.acc_id=orders.acc_id AND account_address.acc_id=account.acc_id AND order_status.order_status_id=orders.order_status_id";
    }



	$result = $conn->query($sql_data);
	$fetch = $result->fetch_assoc();

	$items = explode(";", $fetch['order_product_list']);

	//var_dump($items);

	$products = '';
	foreach ($items as $key) {
		$quantity = explode("-", $key, 2);
		$end = end($quantity);

		$sql_get_prod_name = "SELECT prod_name FROM product WHERE prod_id=".(int)$key;
		$result_name = $conn->query($sql_get_prod_name);
		$fetch_prod_name = $result_name->fetch_assoc();
		if (!($key == '')) {
			$products .= '['.$end.' x '.$fetch_prod_name['prod_name'].']*';	
		}
	}

	$date = date_create($fetch['order_date']);
    if (!isset($_GET['p'])) {
        $date2 = date_create($fetch['receipt_date_paid']);
    }
	
	 

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>BakaAG - Reciept</title>
    
    <style>
	@page { size: auto;  margin: 0mm; }
	@media print {
	/* style sheet for print goes here */
    	.noprint {
    	visibility: hidden;
    	}
        .invoice-box {
            border: none !important;
            box-shadow: none !important;
        }
	}
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {

        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div id="invoice-box" class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title" style="font-size: 20px;">
                                <h1 style="width:100%; max-width:300px; font-family: Helvetica;">Baka<span style="font-family: Helvetica;color:red;">AG</span></h1>
                            </td>
                            
                            <td>
                                Order Number: <?php echo 'ORDER-'.$oid.date("Y"); ?><br>
                                Created: <?php 
                                    if (!isset($_GET['p'])) {
                                        echo date_format($date2, 'F jS Y')."<br>";
                                    }

                                ?>
                                Order Date: <?php echo date_format($date, 'F jS Y'); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                BakaAG, Inc.<br>
                                Daraga, Albay<br>
                                Sagpon, 4500
                            </td>
                            
                            <td>
                                <?php echo $fetch['address_city'].', '.$fetch['address_province'].', '.$fetch['address_zipcode']?><br>
                                <?php echo $fetch['address_country']; ?><br>
                                <?php echo $fetch['acc_fname'].' '.$fetch['acc_lname'];?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td><?php 
                                    if (!isset($_GET['p'])) {
                                        echo "
                                            Recieved By: <b>".$fetch['receipt_custname']."</b> <br>
                                            Date Paid:  <b>".date_format(date_create($fetch['receipt_date_paid']), 'F jS Y')."</b><br>
                                            Address Recieved: <b>".$fetch['receipt_compaddress']."</b>


                                        ";
                                    }
                                ?>

                            </td>


                            <?php 
                                if ($fetch['order_mdpaymnt_id'] == 3) {
                                    echo "
                                        <td>
                                            Paypal Sale/Transaction ID: <b>".$fetch['paypal_sale_id']."</b><br>
                                            Paypal Customer ID:  <b>".$fetch['paypal_payer_id']."</b><br>
                                            Paypal Payment ID:  <b>".$fetch['paypal_payment_id']."</b>
                                        </td>
                                    ";
                                }


                            ?>

                        </tr>
                    </table>
                </td>
            </tr>

            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    <?php if (!isset($_GET['p'])) {echo "Amount Paid"; }?>
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    <?php echo $fetch['order_mdpaymt_name']; ?>
                </td>
                
                <td>

                    <?php
                        if (!isset($_GET['p'])) {
                            echo 'PHP '.number_format($fetch['receipt_amt_paid'],2);
                        }
                    ?>
                    
                </td>

            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <?php 
            	$pr = explode("*", $products);

        		$itemsP = explode(";", $fetch['order_product_list']);
        		$endP = end($itemsP);

        		$arrayID = array();
        		$arrayQuan = array();

        		$j = 0;
        		foreach ($items as $ks) {
        			if (empty($ks)) {
        				break;
        			}
            		$exp = explode("-", $ks, 2);
            		$curr = current($exp);
            		$ended = end($exp);

            		array_push($arrayID, $curr);
            		array_push($arrayQuan, $ended);

            		$j++;
        		}


        		$l = 0;
        		$num_of_elem = count($pr) - 1;
            	foreach ($pr as $ke) {
            		if ($l == $num_of_elem) {
            			break;
            		}

            		$sql_pr = "SELECT * FROM product,inventory WHERE product.prod_id=".$arrayID[$l]." AND product.inv_id=inventory.inv_id";
            		$resultP = $conn->query($sql_pr);
            		if ($arrayID[$l] != '') {
            			$fetchP = $resultP->fetch_assoc();

            		} else {
            			break;
            		}

          			if($fetchP['inv_discount']>0){
          				$a = $fetchP['inv_price'] * ($fetchP['inv_discount'] / 100);
                    	$b = $fetchP['inv_price'] - $a;

          			}
          			else {
          				$b = $fetchP['inv_price'];

          			}

            		echo '
			            <tr class="item">
			                <td>
			                    '.$ke.'
			                </td>
			                
			                <td>PHP
			                    '.number_format(($b * $arrayQuan[$l]),2).'
			                </td>
            			</tr>

            		';
            		$l++;
            	}
            ?>


            
            
            <tr class="total">
                <td>STATUS: <span style="color: darkgreen; font-weight: bold;"><?php echo $fetch['order_status_name']; ?></span></td>
                
                <td>
                   Total: PHP <?php echo number_format($fetch['order_total_amt'],2); ?>
                </td>
            </tr>
        </table>
        <center><button class="noprint" onClick="window.print();">Print this page</button></center>
    </div>



</body>

</html>




