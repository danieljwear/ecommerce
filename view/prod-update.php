<?php



require('../common/header.php');


$categoryList = "<select name='invId' id='invId'>";
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



?>





<main>


<h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | Acme, Inc</h1>
        <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
            <?php
                if (isset($message)) {
                    echo "<h3>". $message . "</h3>";
                }
            ?>
            <form method="post" action="./products/index.php" id="registrationform">
            
                    <div>
                        <input class="inputinvalid" id="invName" name="invName" type="text" required  tabindex="1" placeholder="Enter Item Name" <?php if(isset($invName) && (!isset($success))){echo "value='$invName'";} elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?> >
                        <label for="invName">Item Name</label>
                    </div>
                    <div>
                        <textarea class="textareainvalid" id="invDescription" name="invDescription" rows="5" cols="40" required  tabindex="2" placeholder="Enter the description of the item"><?php if(isset($invDescription) && (!isset($success))){echo $invDescription;} elseif(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; } ?></textarea>
                        <label for="invDescription">Description</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invImage" name="invImage" type="text" required tabindex="3" placeholder="Enter the path to the image item. /acme/images/no-image/no-image.png if none." <?php if(isset($invImage) && (!isset($success))) {echo "value='$invImage'";} elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; } ?> />
                        <label for="invImage">Image Path</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invThumbnail" name="invThumbnail" type="text" required tabindex="4" placeholder="Enter the path to the thumbnail image." <?php if(isset($invThumbnail) && (!isset($success))){echo "value='$invThumbnail'";} elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?> />
                        <label for="invThumbnail">Thumbnail Path</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invPrice" name="invPrice" type="number" required  tabindex="5" step="0.01" min="0" placeholder="Enter the Price." <?php if(isset($invPrice) && (!isset($success))){echo "value='$invPrice'";} elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; } ?> />
                        <label for="invPrice">Price</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invStock" name="invStock" type="number" required tabindex="6" placeholder="Enter the number in Stock." <?php if(isset($invStock) && (!isset($success))){echo "value='$invStock'";} elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; } ?> />
                        <label for="invStock">Qty in Stock</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invSize" name="invSize" type="number" required tabindex="6" placeholder="Enter the Size." <?php if(isset($invSize) && (!isset($success))){echo "value='$invSize'";} elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; } ?> />
                        <label for="invSize">Size</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invWeight" name="invWeight" type="number" step="0.01" min="0" required tabindex="7" placeholder="Enter the Weight." <?php if(isset($invWeight) && (!isset($success))){echo "value='$invWeight'";} elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> />
                        <label for="invWeight">Weight</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invLocation" name="invLocation" type="text" required tabindex="8" placeholder="Enter the location."  <?php if(isset($invLocation) && (!isset($success))){echo "value='$invLocation'";} elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?> />
                        <label for="invLocation">Location</label>
                    </div>
                    <div>
                        <?php echo $categoryList; ?> 
                        <label >Category</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invVendor" name="invVendor" type="text" required tabindex="10" placeholder="Enter the name of the Vendor." <?php if(isset($invVendor) && (!isset($success))){echo "value='$invVendor'";} elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> />
                        <label for="invVendor">Vendor Name</label>
                    </div>
                    <div>
                        <input class="inputinvalid" id="invStyle" name="invStyle" type="text" required tabindex="11" placeholder="Enter the Style of the item." <?php if(isset($invStyle) && (!isset($success))){echo "value='$invStyle'";} elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; } ?> />
                        <label for="invStyle">Style</label>
                    </div>
                    
          
                <input type="hidden" name="action" value="updateProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
                <input type="submit" name="submit" value="Update Product">
                
            </form>
        </main>

    <?php
    require('../common/footer.php'); 
    ?>