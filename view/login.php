<?php
$section = 'login';
require('../common/header.php');

?>

<div class ="regbox"><br>
<h1> Login</h1><br>


<?php
if (isset($message)) {
   echo $message;
  }

if (isset($_SESSION['message'])) {
   echo $_SESSION['message'];
  }
?>
<hr><br>
<form  action="/acme/accounts/" method="POST">


<input name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> type="email" placeholder=" Email" maxlength="45" required><br>
<input type="password" id="clientPassword" placeholder=" Password"  name="clientPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and special character, and at least 8 or more characters" required>

 <input type="submit"  name="submit" value="login">
<input type="hidden" name="action" value="login">

</form>

<br>
<h1> Don't Have an Account? </h1><h2><?php echo $createAccount?></h2> 
</div>



 <?php
    require('../common/footer.php'); 
    ?>