<?php

$categoryList = "<select name='categoryId' id='categoryId'>";
foreach ($category_Id as $catId)  {
$categoryList .= "<option value='$catId[categoryId]'";
if(isset($categoryId)){
     if($catId['categoryId']===$categoryId){
          $categoryList.= ' selected ';
     }
}

$categoryList.= ">$catId[categoryName]</option>";
}
$categoryList.='</select>';





require('../common/header.php');

?>

<div class ="regbox"><br>
      <h1> Add a Product Category </h1><br>
      <hr><br>

      <?php
      if (isset($message)) {
      echo $message;
      }
      ?>



      <form method="post" action="/acme/products/index.php">
      <?php echo $categoryList; ?>
      <input name="invName" id="invName" type="text" <?php if(isset($invName)){echo "value='$invName'";}  ?> placeholder=" Add Product Name" maxlength="20" required><br>
      <input name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> type="text" placeholder=" Add Product Description" maxlength="120" required><br>
      <input name="invImage" id="invImage" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> type="url" placeholder="Add Image URL" maxlength="60" required><br>
      <input name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> type="url" placeholder="Add Thumbnail URL" maxlength="60" required><br>
      <input name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> type="number" placeholder=" Add Price in USD"  required><br>
      <input name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> type="number" placeholder=" Add Number in Stock"  required><br>
      <input name="invSize" id="invSize" <?php if(isset($invSize)){echo "value='$invSize'";}  ?> type="text" placeholder=" Add Size | W x H x L" maxlength="20" required><br>
      <input name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";}  ?> type="number" placeholder=" Add Weight in Pounds"   required><br>
      <input name="invLocation" id="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";}  ?>type="text" placeholder=" Add a Location" maxlength="20" required><br>
      <input name="invVendor" id="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";}  ?> type="text" placeholder=" Add Vendor" maxlength="20" required><br>
      <input name="invStyle" id="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";}  ?> type="text" placeholder=" Add Style" maxlength="20" ><br>



      <input type="submit" name="submit" class="regbtn" value="Add Product">
      <input type="hidden" name="action" value="update_product">

      </form>
      <br>
      <br>


</div>

 <?php
    require('../common/footer.php'); 
    ?>