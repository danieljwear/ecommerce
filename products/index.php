<?php
session_start();


require_once '../paths.php';
require_once LIB.'connections.php';
require_once MODEL.'product-model.php';
require_once LIB.'functions.php';

//// Account Info IN Header
if (isset($_GET['logout'])) {
  logoff();
}

//Header
if (isset($_SESSION['loggedin'])) {
  $clientData = getClient($_SESSION['clientData']['clientEmail']);
  array_pop($clientData);
  $name = $_SESSION['clientData']['clientFirstname'];
}
  if (isset($_SESSION['loggedin'])) { 

    $accountLink = "<div class='welcome'> Welcome $name  </div>";
    $accountLink.=  '<div class="login"><img src="images/site/account.gif" alt="account"> <a href="./accounts/"> My Account  </a></div>';
    $accountLink.= "<div id='logout'><a href='./accounts/index.php?logout=true'>Logout</a></div> ";
             } else {
        $accountLink =  '<div class="login"><img src="images/site/account.gif" alt="account"> <a href="./accounts/"> My Account  </a></div>';
           
          }

//Navigation
$navList=nav();



 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


$addCategory ='<a href="./products/?action=updateCategory">Add New Category</a>'; 
$addProduct='<a href="./products/?action=update_product">Add Products</a>';


$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$prodcat = urldecode(filter_input(INPUT_GET, 'prodcat', FILTER_SANITIZE_STRING));

$category_Id= getCategoryId();



switch ($action){


   case 'updateCategory':    
        $categoryName = filter_input(INPUT_POST, 'categoryName',FILTER_SANITIZE_STRING);

        if  (empty($categoryName)){
          $message='<p> Please provide information for all empty form fields.</p>';
          include '../view/updateCategory.php';
          break;
          }
        $updateOutcome = productCategory($categoryName);

        if ($updateOutcome === 1 ) {
        $message = "<p> The new category called, $categoryName, has been added. ";
        include '../view/product_management.php';
          break;
        } else {
        $message ="<p> Sorry the update for $categoryName, failed. Please try again. </p>";
        include '../view/updateCategory.php';
        exit;
        }
   break;



   ///Update Product
   
   case 'update_product':


 
      $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING,FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING);
      $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_STRING);
      $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_STRING,FILTER_FLAG_ALLOW_FRACTION);
      $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
      $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_STRING);
      $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
      $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);


      if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)){
          $message='<div class="red"><p> Please provide information for all empty form fields.</p></div>';
          include '../view/update_product.php';
         break;
          }

       $updateOutcome = addProduct($invName,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invSize,$invWeight,$invLocation,$categoryId,$invVendor,$invStyle);

    
    
   
       if ($updateOutcome === 1 ) {
       $message = "<p> The new item called, $invName, has been added. ";
       include '../view/product_management.php';
       break;
       } else {
       $message ="<p> Sorry the update for $invName, failed. Please try again. </p>";
       include '../view/update_product.php';
       exit;
       }


       

  break;


  ///// Modify Product 
  case 'mod':
  $prodLis = productEdit();
  $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $prodInfo = getProductInfo($invId);
  if(count($prodInfo)<1){
   $message = 'Sorry, no product information could be found.';
  }
  include '../view/prod-update.php';
  exit;
 break;

 //// Delete Product 

case 'deleteProd':
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

 $deleteResult = deleteProduct($invId);
 if ($deleteResult) {
  $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 } else {
  $message = "<p class='notice'>Error: $invName was not deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 }
 break;

 case 'del':
 $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($invId);
 if (count($prodInfo) < 1) {
 $message = 'Sorry, no product information could be found.';
 }
 include '../view/prod-delete.php';
 exit;
break;


 case 'updateProd':
 $invId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_STRING);
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
 $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
 $invThumb = filter_input(INPUT_POST, 'invThumb', FILTER_SANITIZE_STRING);
 $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
 $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
 $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
 $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
 $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
 $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
 if (empty($invId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumb) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
 include '../view/prod-update.php';
 exit;
}  

$insertResult =  updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId);

 if ($insertResult) {
  $message = "<p>Congratulations, $invName was successfully added.</p>";
  include '../view/prod-update.php';
  exit;
 } else {
  $message = "<p>Error. The new product was not added.</p>";
 include '../view/prod-update.php';
 exit;
}
 break;

 case 'category':
 $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
 $products = getProductsByCategory($categoryName);
 if(!count($products)){
  $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
 } else {
  $prodDisplay = buildProductsDisplay($products);
 }
 include '../view/category.php';
 break;

 case 'proddetail':
 $type = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
 $product = getProductInfo($type);
 
 if(!count($product)) {
     $message = "<p class='notice'>Sorry, no $prodname products could be found.</p>";
 } else {
     $prodDisplay = buildProduct($product);
 }

 $thumbnail = thumbnail($type);
 $thumbnail['invPath'] = $thumbnail['imgPath'];
 if(!count($thumbnail)) {
  $message = "No other images";
} else {
  $thumb = "<img src='$thumbnail[invPath]' alt='thumbnail' />";
}
 include '../view/productdetails.php';



break;
  
  default:
  
  array_pop($clientData);
  $prodList = productEdit();

  if(count($products) > 0){
   $prodList = '<table>';
   $prodList .= '<thead>';
   $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
   $prodList .= '</thead>';
   $prodList .= '<tbody>';
   foreach ($products as $product) {
    $prodList .= "<tr><td>$product[invName]</td>";
    $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
    $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
   }
    $prodList .= '</tbody></table>';
   } else {
    $message = '<p class="notify">Sorry, no products were returned.</p>';
 }
  


 if( $_SESSION['clientData']['clientLevel'] > 1) {
  include '../view/product_management.php';}
  else {
    include '../view/home.php';
}
 }
?>