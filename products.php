<?php
include_once("backend/connection.php");
include_once("header.php");
$productid = $_GET['prod_id'];
$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND prod_id=".$productid;
$result = $conn->query($sql);
$result = $result->fetch_assoc();

if ($result['inv_discount'] == 0) {
  $tts_price = number_format($result['inv_price'] ,2);
} else {
  $tts_price = number_format($result['inv_price'] - ($result['inv_price'] * ($result['inv_discount'] * 0.01)),2);

}

$addToViews = "UPDATE product,inventory SET inv_views = inv_views + 1 WHERE product.inv_id=inventory.inv_id AND prod_id=".$productid;
$conn->query($addToViews);

$TTS_data = $result['prod_name'].". Price. ".$tts_price." . Pesos";



?>
<!DOCTYPE html>
<html>
<head>
	<title>BakaAG</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/admin/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
  <? echo $result['prod_picture_link'];?>
<br><br>
<div class="container-fluid">
<div class="row container-center">
	<div class="col-lg-5">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 30rem;">
  <div class="card-header"><h4 style="display: inline-block !important;"><?php echo $result['prod_name']?></h4><input class="btn btn-link" style="display: inline-block !important; cursor: pointer;" onclick='responsiveVoice.speak(<?php echo "\"".$TTS_data."\""; ?>, "Japanese Female");' type='button' value='🔊' /></div>
  <div class="card-body text-primary">
    <h4 class="card-title"></h4>
    <p class="card-text"> 
    	<?php echo '<div id="main-image" style="width: 350px; height: 250px;  background-image: url(\''.$result['prod_picture_link'].'\'); background-size: cover; background-repeat: no-repeat; background-position:center center;" class="img-responsive"></div>';?>
    	<!--<div class="row small-thumbnail">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#1"><div id="thumbA" style="width: 60px; height: 60px;  background-image: url('img/1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
        <a href="#2"><div id="thumbB" style="width: 60px; height: 60px;  background-image: url('img/2.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
        <a href="#3"><div id="thumbC" style="width: 60px; height: 60px;  background-image: url('img/3.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
        <a href="#4"><div id="thumbD" style="width: 60px; height: 60px;  background-image: url('img/4.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
    	</div>-->
    </p>
    </div>
  </div>
</div>
</div>
	
  <div id="success" style="display: none; position: fixed; width: 25%; top: 80%; left: 70%; z-index: 100;"
  class="alert alert-dismissible alert-success"> 
    <strong>Success!</strong> 
  </div>

  <div id="error" style="display: none; position: fixed; width: 25%; top: 80%; left: 70%; z-index: 100;"
  class="alert alert-dismissible alert-danger"> 
    <strong>Error!</strong> 
  </div>

	<div class="col-lg-7 data-container">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 65rem;">
  <div class="card-header">Product Details</div>
  <div class="card-body text-primary">
    <h4 class="card-title">PHP 
      <?php 

        if ($result['inv_discount'] == 0) {
          echo number_format($result['inv_price'] ,2);
        } else {
          echo number_format($result['inv_price'] - ($result['inv_price'] * ($result['inv_discount'] * 0.01)),2);
          echo "<p style='color:orange;'>".$result['inv_discount']."% OFF! </p>";
        }
        
        
        ?>
          
    </h4>
    <p class="card-text">
      <button type="button" class="btn btn-primary" style="cursor: pointer;" onclick="addtocart(<?php echo $result['prod_id']?>)">Add to cart</button>
    	<span class="glyphicon glyphicon-shopping-heart"></span>
        <?php
          if (isset($_SESSION['acc_id'])) {
            $sql_wish = "SELECT * FROM wishlist WHERE acc_id=".$_SESSION['acc_id']." AND prod_id=".$_GET['prod_id'];
            $result_wish = $conn->query($sql_wish);

            if (mysqli_num_rows($result_wish) > 0) {
              echo '<button type="button" class="btn btn-primary disabled">Product already in wishlist</button>';
            } else {
              echo '<button type="button" id="addToWishlist" style="cursor: pointer;" class="btn btn-primary">Add to wishlist</button>';
            }
            
            echo '<input id="acc_id" type="number" class="hidden" value="'.$_SESSION['acc_id'].'" >';
            echo '<input id="prod_id" type="number" class="hidden" value="'.$_GET['prod_id'].'" >';
            echo '<input id="inv_id" type="number" class="hidden" value="'.$result['inv_id'].'" >';
          }




        ?>
    	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Product Type</th>
      <th scope="col">Genre</th>
      <th scope="col">Stock</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-active">
      <th scope="row"><?php
              $sql2 = "SELECT prod_type_name FROM product_type WHERE prod_type_id=".$result['prod_type_id'];
              $result2 = $conn->query($sql2);
              $result2 = $result2->fetch_assoc();
              echo $result2['prod_type_name'];
          ?></th>
      <td><?php
              $sql2 = "SELECT prod_genre_name FROM product_genre WHERE prod_genre_id=".$result['prod_genre_id'];
              $result2 = $conn->query($sql2);
              $result2 = $result2->fetch_assoc();
              echo $result2['prod_genre_name'];
          ?></td>
      <td><?php
              if($result['inv_stock']>0)
                echo "In stock";
              else
                echo "Out of stock";
          ?></td>
    </tr>
  </tbody>
</table>

    

    <div>
<?php
  $sql_rating_sum = "SELECT SUM(rate_num) AS total FROM rating WHERE inv_id=".$result['inv_id'];
  $sql_rating_count = "SELECT COUNT(rate_num) AS counter FROM rating WHERE inv_id=".$result['inv_id'];
  $sql_check_rating = "SELECT * FROM rating WHERE inv_id=".$result['inv_id'];

  $result_check_rating = $conn->query($sql_check_rating);

  $people_rates = "(0 people voted for this item)";

  if (mysqli_num_rows($result_check_rating) > 0) {
      $result_rating_sum = $conn->query($sql_rating_sum);
      $result_rating_count = $conn->query($sql_rating_count);

      $fetch_sum = $result_rating_sum->fetch_assoc();
      $fetch_count = $result_rating_count->fetch_assoc();

      $sum = $fetch_sum['total'];
      $count_rating = $fetch_count['counter'];

      $formula = ($sum / $count_rating) / 5 * 100;
      $star = '';
      $people_rates = " (".$fetch_count['counter']." user(s) voted for this item)";

      for ($i=1; $i <= $formula; $i++) { 
        if (($i % 20) == 0) {
          $star .= "★";
        }
      }
  } else {
      $star = "NO RATING";
  }

  echo '<h4>RATING: '.'<span style="color:gold !important;">'.$star.'</span><small>'.$people_rates.'</small></h4>';


  if (isset($_SESSION['acc_id'])) {
    echo '
        <ul class="pagination">
          <li class="page-item">
            <a id="rate-btn-1" style="cursor:pointer;" class="page-link">1</a>
          </li>
          <li class="page-item">
            <a id="rate-btn-2" style="cursor:pointer;" class="page-link">2</a>
          </li>
          <li class="page-item">
            <a id="rate-btn-3" style="cursor:pointer;" class="page-link">3</a>
          </li>
          <li class="page-item">
            <a id="rate-btn-4" style="cursor:pointer;" class="page-link">4</a>
          </li>
          <li class="page-item">
            <a id="rate-btn-5" style="cursor:pointer;" class="page-link">5</a>
          </li>
        </ul>
      
    ';
  }



?>

    </div>



<hr>
<h4>Product Description</h4>
<p><?php echo $result['prod_desc']?></p>

    </p>
    </div>
  </div>
</div>

  <div class="card border-primary mb-3" style="height: 600px;">
    <div class="card-header">Comments</div>
      <div class="card-body" style="padding-bottom: 20px;  overflow-y: scroll;">

        <?php  
          if (isset($_SESSION['acc_id'])) {
              echo '
                <div class="form-group">
                  <textarea id="comment-box" maxlength="380" placeholder="Enter Comment" class="form-control" id="exampleTextarea" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 107px;"></textarea>
                  <button id="add-comment" style="cursor:pointer;" class="btn btn-primary btn-sm">Add Comment</button>
                </div>

              ';
          }
        ?>

        <div id="comment-container" class="comment-container">
            <?php
              $sql = "SELECT * FROM comments,account WHERE comments.prod_id=".$_GET['prod_id']." AND comments.acc_id=account.acc_id ORDER BY comment_date DESC LIMIT 6";
              $result_comments = $conn->query($sql);


              if (mysqli_num_rows($result_comments)  < 1) {
                    echo "<center><small>NO COMMENTS</small></center>";
              }

              $viewAllComments = '';
              if (mysqli_num_rows($result_comments) >= 6) { 
                  $viewAllComments = '<center><button id="view-all" style="cursor:pointer;" class="btn btn-primary btn-sm">View All Comments</button></center>';
              }


              while ($getComments = $result_comments->fetch_assoc()) {
                  echo '
                        <div>
                            <span class="badge badge-info">'.$getComments['acc_fname']." ".$getComments['acc_lname'].'</span><br><br>
                            <p style="text-align: justify;">'.$getComments['content'].'</p>
                            <small>'.date('g:ia \o\n l jS F Y', strtotime($getComments['comment_date'])).'</small>
                          <hr>
                        </div>
                  ';
              }
              echo $viewAllComments;


            ?>
        </div>


      </div>
   </div>


  <div class="card border-primary mb-3" id="all-comments" style="padding-bottom: 10px; width: 90%; z-index: 300; position: fixed; display: none; top: 0; left: 0; top: 5%; left: 5%;">
    <div class="card-header">Comments</div>
      <div class="card-body" style="padding-bottom: 20px; height: 450px; overflow-y: scroll;">
        <div id="comment-container-all" class="comment-container">
            <?php  
                $sql_getAllComments = "SELECT * FROM comments,account WHERE comments.prod_id=".$_GET['prod_id']." AND comments.acc_id=account.acc_id ORDER BY comment_date DESC";
                $result_comments_all = $conn->query($sql_getAllComments);

                while ($getAllComments = $result_comments_all->fetch_assoc()) {
                  echo '
                        <div>
                            <span class="badge badge-info">'.$getAllComments['acc_fname']." ".$getAllComments['acc_lname'].'</span><br><br>
                            <p style="text-align: justify;">'.$getAllComments['content'].'</p>
                    
                            <small>'.date('g:ia \o\n l jS F Y', strtotime($getAllComments['comment_date'])).'</small>
                          <hr>
                        </div>
                  ';
                }
            ?>
            
            
        </div>


      </div>
      <button id="close-view-all" style="cursor:pointer; margin-left: 10px;" class="btn btn-primary btn-sm">Close</button>
   </div>



</div>
	
</div>
</div>


<script type="text/javascript" src="js/funcs.js"></script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</body>
</html>
<?php 
	include_once("footer.php");
?>
