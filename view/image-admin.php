<?php
require('../common/header.php'); 
 ?>
 
 <main> 
<?php if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
} ?>

<h2>Add New Product Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
 <label>Product</label><br>
 <?php echo $prodSelect; ?><br><br>
 <label>Upload Image:</label><br>
 <input type="file" name="file1"><br>
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>

<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>

</main>
<?php
    require('../common/footer.php');  ?>

<?php unset($_SESSION['message']); ?>