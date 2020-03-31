<?php 



//// Adds  Category Types 
function productCategory($categoryName){
   $db = acmeConnect();
   $sql = 'INSERT INTO categories (categoryName)
            VALUES (:categoryName)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
  }
  
function addProduct($invName,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invSize,$invWeight,$invLocation,$categoryId,$invVendor,$invStyle){
    
    $db = acmeConnect();
    
    $sql = 'INSERT INTO inventory (invName,invDescription,invImage,invThumbnail,invPrice,invStock,invSize,invWeight,invLocation,categoryId,invVendor,invStyle)
        VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
    
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription , PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage , PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail , PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice , PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock , PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize , PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight , PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation , PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId , PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor , PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle , PDO::PARAM_STR);
    $stmt->execute();
    
    $rowsChanged = $stmt->rowCount();
    
    $stmt->closeCursor();
    
    return $rowsChanged;
   }



function getCategoryId() {
    $db = acmeConnect(); 
    $sql = 'SELECT categoryId, categoryName FROM categories ORDER BY categoryId ASC'; 
    $stmt = $db->prepare($sql);
    $stmt->execute(); 
    $catId = $stmt->fetchAll(); 
    $stmt->closeCursor(); 
    return $catId;
   }

   function getClientLevel($clientLevel){
    $db = acmeConnect();
    $sql = 'SELECT  clientLevel
            FROM clients
            WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientLevel, PDO::PARAM_STR);
    $stmt->execute();
    $clientLevel = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientLevel;
   }

   function thumbnail($tnImgPath){
       $db = acmeConnect();
       $sql ="SELECT imgPath from images where invID = :invId AND imgPath LIKE '%-tn%'";
       $stmt = $db->prepare($sql);
       $stmt->bindValue(':invId', $tnImgPath, PDO::PARAM_STR);
       $stmt->execute();
       $tnImgPath = $stmt->fetch(PDO::FETCH_ASSOC);
       $stmt->closeCursor();
       return $tnImgPath;
   }


   function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
   }


    function updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId){
        $db = acmeConnect();
        $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryid = :categoryid, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT );
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT );
        $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT );
        $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT );
        $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
        $stmt->bindValue(':categoryid', $categoryId, PDO::PARAM_INT );
        $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
        $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function deleteProduct($invId) {
        $db = acmeConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
       }



       function getProductInfo($invId){
        $db = acmeConnect();
        $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $prodInfo;
       }


       function getProductsByCategory($categoryName){
        $db = acmeConnect();
        $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
       }
      

    

   ?>