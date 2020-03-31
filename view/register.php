<?php

require('../common/header.php');

?>

<div class ="regbox"><br>
<h1> Welcome!</h1><p> Register Below to Start Your Wacky Adventure</p><br>
<hr><br>

<?php
if (isset($message)) {
 echo $message;
}
?>
<form method="post" action="/acme/accounts/index.php">

<input name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> type="text" placeholder=" First Name" maxlength="20" required><br>
<input name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> type="text" placeholder=" Last Name" maxlength="30" required><br>
<input name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> type="email" placeholder=" Email" maxlength="45" required><br>
<input name="clientPassword" id="clientPassword" type="password"  placeholder=" Password"  pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

<!-- "-->


<input type="submit" name="submit" class="regbtn" value="Register">
<input type="hidden" name="action" value="register">
</form>
           <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
  <p id="special" class="invalid">A <b>special</b> character</p>
</div>
<br>
<br>
<h1> Do you already have an account? </h1><h2><?php echo $loginPage ?></h2> 
</div>

 <?php
    require('../common/footer.php'); 
    ?>