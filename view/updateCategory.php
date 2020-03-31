<?php

require('../common/header.php');

?>

<div class ="regbox"><br>
<h1> Add a Product Category </h1><br>
<hr>

<?php
if (isset($message)) {
 echo $message;
}
?>
<form method="post" action="/acme/products/index.php">

<input name="categoryName" id="categoryName" <?php if(isset($categoryName)){echo "value='$categoryName'";}  ?> type="text" placeholder=" Add a Category" maxlength="20" ><br>

<input type="submit" name="submit" class="regbtn" value="Update">
<input type="hidden" name="action" value="updateCategory">
</form>
     
<br>
<br>
<h1> Wrong Place? </h1><h2><?php echo $addProduct ?></h2> 
</div>

 <?php
    require('../common/footer.php'); 
  ?>