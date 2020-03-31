<?php

require('../common/header.php');

?>
<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 if (isset($_SESSION['message'])) {
   $message = $_SESSION['message'];
  }
 exit;
}
?>
<div class ="regbox"><br>
<h1> Product Menu </h1><br>
<hr><br>


<?php
if (isset($message)) {
 echo $message;
} if (isset($prodList)) {
 echo $prodList;
}
?>


<h2><?php echo $addCategory?></h2> 
<h2><?php echo $addProduct?></h2> 

</div>
<?php unset($_SESSION['message']); ?>
 <?php
    require('../common/footer.php'); 
    ?>