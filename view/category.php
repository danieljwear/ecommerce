<?php
require('../common/header.php'); 
 ?>

<h1><?php echo $categoryName; ?> Products</h1>


<?php if(isset($message)){
 echo $message; } 
 ?>

<?php if(isset($prodDisplay)){ 
 echo $prodDisplay; 
} ?>

<?php
    require('../common/footer.php');  ?>