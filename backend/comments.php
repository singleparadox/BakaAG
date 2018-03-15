<?php
	include_once "connection.php";

	$uid = $_POST['uid'];
	$pid = $_POST['pid'];
	$content = $_POST['comment'];

	$sql_insert = "INSERT INTO comments (prod_id, acc_id, content) VALUES (".$pid.", ".$uid.", '".$content."')";
	$conn->query($sql_insert);

	$sql_select = "SELECT * FROM comments,account WHERE comments.prod_id=".$pid." AND comments.acc_id=account.acc_id ORDER BY comment_date DESC LIMIT 6";
	$result_select = $conn->query($sql_select);

	$viewAllComments = '';
	if (mysqli_num_rows($result_select) >= 6) { 
		$viewAllComments = '<center><button style="cursor:pointer;" class="btn btn-primary btn-sm">View All Comments</button></center>';
	}

	$data = '';

	while ($row = $result_select->fetch_assoc()) {
		$data .= '
		    <div>
                <span class="badge badge-info">'.$row['acc_fname']." ".$row['acc_lname'].'</span><br><br>
                <p style="text-align: justify;">'.$row['content'].'</p>
                <small>'.date('g:ia \o\n l jS F Y', strtotime($row['comment_date'])).'</small>
              <hr>
            </div>

            ';
	}
	echo $data.$viewAllComments;

?>