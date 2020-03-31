<?php
$section = 'admin';
require('../common/header.php');?>

<div class ="regbox"><br>
<h1> Login</h1><br>
<?php 
    $clientData = getClient($_SESSION['clientData']['clientEmail']); 
?><ul class="user">
  <li>First Name: <strong><?php echo $_SESSION['clientData']['clientFirstname']; ?></strong></li>
                <li>Last Name: <strong><?php echo $_SESSION['clientData']['clientLastname']; ?></strong></li>
                <li>Email: <strong><?php echo  $_SESSION['clientData']['clientEmail']; ?></strong></li>
                

                <?php echo ($updateuser) ?>
            </ul>
            <?php if( $_SESSION['clientData']['clientLevel'] > 2) {
                echo "  <a href='./products'>Products Page</a>";
           }   ?>
            
</div>
 <?php
    require('../common/footer.php'); 
    ?>