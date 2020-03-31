 <?php require '../common/header.php'; ?>
 <main>
   <h1><?php echo $product['invName']; ?></h1>
            <?php if(isset($message)){ echo $message; } ?>
            <div  class="prodInfo">
                <div class="prodImage">
                    <img src='<?php echo $imgpath . $product['invImage']; ?>' id='prodImage' alt='Image of <?php echo $product['invName']; ?> on Acme.com'>
                </div>
                
                <div class="prodDetails">
                <h4 id="prodDescription">Description: <?php echo $product['invDescription']; ?></h4>

                    <p id="prodPrice">Price: <?php echo $product['invPrice']; ?></p>

                    <p id="prodStock"># in Stock: <?php echo $product['invStock']; ?></p>

                    <p id="prodWeight">Product Weight: <?php echo $product['invWeight']; ?></p>

                    <p id="prodLocation">Location of Item: <?php echo $product['invLocation']; ?></p>

                    <p id="prodStyle">Style: <?php echo $product['invStyle']; ?></p>
                </div>
                <hr>
        
                <?php echo $thumb; ?>
                <hr>
             
         
   </div>
 </main>
        
    <?php require "../common/footer.php" ?>