        <?php require '../common/header.php'; ?>

        <main>
        <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
            <?php
                if (isset($message)) {
                    echo "<h3>". $message . "</h3>";
                }
            ?>
            <p>Confirm Product Deletion. The delete is permanent.</p>
            
            <form method="post" action="<?php echo $basepath ?>/products/index.php" id="registrationform">
                <fieldset> 
                    <div>
                        <input class="inputinvalid" id="invName" name="invName" type="text" readonly <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?> >
                        <label for="invName">Item Name</label>
                    </div>
                    <div>
                        <textarea class="textareainvalid" id="invDescription" name="invDescription" rows="5" cols="40" readonly> <?php if(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; } ?></textarea>
                        <label for="invDescription">Description</label>
                    </div>
                </fieldset>

                <input type="submit" name="submit" value="Delete Product">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
                
            </form>

            <?php require '../common/footer.php'; ?>